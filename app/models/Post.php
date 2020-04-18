<?php
class Post
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Get All Posts
  public function getPosts()
  {
    $this->db->query("SELECT * FROM posts");

    $results = $this->db->resultset();

    return $results;
  }


  // Add Post
  public function addPost($data)
  {


    $prepAddr = str_replace(' ', '+', $data['address']);
    $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false&key=AIzaSyAzxkmF000qxt3Kqvni87BjmiP7PbZd32s&v');
    $output = json_decode($geocode);

    $longitude = $output->results[0]->geometry->location->lat;
    $latitude = $output->results[0]->geometry->location->lng;


    // Prepare Quepry
    $this->db->query('INSERT INTO posts (name,email,phone,address,lng,lat) 
      VALUES (:name,:email,:phone,:address,:lng,:lat)');

    // Bind Values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':lng', $longitude);
    $this->db->bind(':lat', $latitude);


    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
