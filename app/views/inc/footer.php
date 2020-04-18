</body>

</html>
<?php
$positions = array();
foreach ($data['posts'] as $key) {

    $positions[] = array(
        'lat' =>   $key->lat,
        'lng' =>   $key->lng,
        'name' =>  $key->name,
        'address' => $key->address
    );
}

?>
<script>
    var positions = <?php echo json_encode($positions) ?>;

    function initMain() {
        initMap();
        initAutocomplete();
    }

    function initMap() {

        myLatLng = {
            lat: 47.369330,
            lng: 18.874550
        };

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: myLatLng
        });

        var contentString = '<div id="content">' +
            '<h4>Húzzon a kívánt címre!</h4>' +
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });


        var marker = new google.maps.Marker({
            draggable: true,
            position: {
                lat: 47.497913,
                lng: 19.040236
            },
            map: map,
            title: "Your location"
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });


        var geocoder = new google.maps.Geocoder;


        google.maps.event.addListener(marker, 'dragend', function(event) {
            document.getElementById("submit").style.display = "";



            document.getElementById('submit').addEventListener('click', function() {
                geocodeLatLng(geocoder, map, infowindow);

            });
            document.getElementById('coords').value = event.latLng.lat() + ',' + event.latLng.lng();
        });



        function geocodeLatLng(geocoder, map, infowindow) {
            var input = document.getElementById('coords').value;
            var latlngStr = input.split(',', 2);
            var latlng = {
                lat: parseFloat(latlngStr[0]),
                lng: parseFloat(latlngStr[1])
            };
            geocoder.geocode({
                'location': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(7);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        var final = results[0].formatted_address
                        var split = final.split(',', 4);

                        var zip_split = split[2].split(/\b(\s)/)
                        var loc_split = split[1].split(".")

                        document.getElementById('locality').value = split[0];
                        document.getElementById('route').value = loc_split[0];
                        document.getElementById('street_number').value = loc_split[1];
                        document.getElementById('postal_code').value = zip_split[0];
                        document.getElementById('country').value = zip_split[2];

                        if (document.getElementById('street_number').value == "undefined") {
                            document.getElementById('street_number').value = "";
                        }


                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }



        positions.forEach(function(data, index) {

            var pos = new google.maps.LatLng(data.lng, data.lat);


            var contentString = '<div id="content">' +
                '<h4>Név:' + data.name + '</h4>' +
                '<p>Cím:' + data.address + '</p>' +
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                icon: image
            });
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

        });

    }

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete')), {
                types: ['geocode']
            });

        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById('autocomplete').value;

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                document.getElementById('coords').value = latitude + ',' + longitude;
            }
        });
    }

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing,places&key=AIzaSyAzxkmF000qxt3Kqvni87BjmiP7PbZd32s&v=3&libraries=places&callback=initMain"></script>