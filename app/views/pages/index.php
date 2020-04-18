<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
  #map {
    height: 50%;
  }

  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>

<div id="map"></div>

<div class="container">

  <div class="card card-body bg-light mt-5">
    <h2>Partner felvétele</h2>
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
      <div class="form-group">
        <label>Név:</label>
        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php if (isset($_POST["name"])) {
                                                                                                                                                    echo $_POST['name'];
                                                                                                                                                  } ?>" placeholder="Adjon meg nevet...">
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>

        <label>Email:</label>
        <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?> <?php echo (!empty($data['email_err2'])) ? 'is-invalid' : ''; ?>" value="<?php if (isset($_POST["email"])) {
                                                                                                                                                                                                                        echo $_POST['email'];
                                                                                                                                                                                                                      } ?>" placeholder="Adjon meg email címet...">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        <span class="invalid-feedback"><?php echo $data['email_err2']; ?></span>

        <label>Telefon:</label>
        <input type="text" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?> <?php echo (!empty($data['phone_err2'])) ? 'is-invalid' : ''; ?>" value="<?php if (isset($_POST["phone"])) {
                                                                                                                                                                                                                        echo $_POST['phone'];
                                                                                                                                                                                                                      } ?>" placeholder="Adjon meg telefonszámot...">
        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
        <span class="invalid-feedback"><?php echo $data['phone_err2']; ?></span>
        <br>

        <div class="panel-heading">
          <h3 class="panel-title">Pontos cím</h3>
          <p style="font-weight:bold;">Kezdje el begépelni az adott címet, vagy a fent található Google térképen látható <img style="width:20px;" src="public/marker.png" alt="Marker"> jelölésével adjon meg koordinátákat, majd kattintson a <i>Cím beállítása</i> gombra</p>
        </div>
        <div class="panel-body">
          <input id="autocomplete" placeholder="Kezdje el begépelni a címet..." onFocus="geolocate()" type="text" class="form-control form-control-lg">
          <br>
          <label class="control-label">Koordináták</label>
          <input class="form-control form-control-lg" placeholder="Koordináták" id="coords" name="coords" value="<?php if (isset($_POST["coords"])) {
                                                                                                                    echo $_POST['coords'];
                                                                                                                  } ?>">
          <input id="submit" type="button" class="btn btn-primary mt-2" value="Cím beállítása" style="display:none;">
          <div id="address">
            <div class="row">
              <div class="col-md-6">
                <label class="control-label">Házszám</label>
                <input class="form-control form-control-lg <?php echo (!empty($data['s_number_err'])) ? 'is-invalid' : ''; ?>" id="street_number" name="s_number" value="<?php if (isset($_POST["s_number"])) {
                                                                                                                                                                            echo $_POST['s_number'];
                                                                                                                                                                          } ?>" placeholder="Házszám">
                <span class="invalid-feedback"><?php echo $data['s_number_err']; ?></span>
              </div>
              <div class="col-md-6">
                <label class="control-label">Utca</label>
                <input name="street" class="form-control form-control-lg <?php echo (!empty($data['street_err'])) ? 'is-invalid' : ''; ?>" id="route" value="<?php if (isset($_POST["street"])) {
                                                                                                                                                                echo $_POST['street'];
                                                                                                                                                              } ?>" placeholder="Utca">

                <span class="invalid-feedback"><?php echo $data['street_err']; ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="control-label">Város</label>
                <input name="city" class="form-control field form-control-lg  <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" id="locality" value="<?php if (isset($_POST["city"])) {
                                                                                                                                                                      echo $_POST['city'];
                                                                                                                                                                    } ?>" placeholder="Város">
                <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
              </div>

            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="control-label">Irányítószám</label>
                <input name="zip" class="form-control form-control-lg <?php echo (!empty($data['zip_err'])) ? 'is-invalid' : ''; ?>" id="postal_code" value="<?php if (isset($_POST["zip"])) {
                                                                                                                                                                echo $_POST['zip'];
                                                                                                                                                              } ?>" placeholder="Irányítószám">
                <span class="invalid-feedback"><?php echo $data['zip_err']; ?></span>
              </div>
              <div class="col-md-6">
                <label class="control-label">Ország</label>
                <input name="country" class="form-control form-control-lg  <?php echo (!empty($data['country_err'])) ? 'is-invalid' : ''; ?>" id="country" value="<?php if (isset($_POST["country"])) {
                                                                                                                                                                    echo $_POST['country'];
                                                                                                                                                                  } ?>" placeholder="Ország">
                <span class="invalid-feedback"><?php echo $data['country_err']; ?></span>
              </div>
            </div>
          </div>
        </div>
        <br>
        <input type="submit" class="btn btn-success" value="Elküldés">
      </div>
  </div>
  </form>
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>