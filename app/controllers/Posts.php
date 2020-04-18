<?php
class Posts extends Controller
{
  public function __construct()
  {


    $this->postModel = $this->model('Post');
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'name' => trim($_POST['name']),
        'country' => trim($_POST['country']),
        'zip' => trim($_POST['zip']),
        'city' => trim($_POST['city']),
        'street' => trim($_POST['street']),
        's_number' => trim($_POST['s_number']),
        'address' => $_POST['country'] . " " . $_POST['zip'] . " " . $_POST['city'] . " " . $_POST['street'] . " " . $_POST['s_number'],
        'phone' => trim($_POST['phone']),
        'email' => trim($_POST['email']),
        'name_err' => '',
        'phone_err' => '',
        'phone_err2' => '',
        'email_err' => '',
        'email_err2' => '',
        'country_err' => '',
        'zip_err' => '',
        'city_err' => '',
        'street_err' => '',
        's_number_err' => ''
      ];


      if (empty($data['name'])) {
        $data['name_err'] = 'Kérem adjon meg nevet';
      }

      if (empty($data['email'])) {
        $data['email_err'] = 'Kérem adjon meg email címet';
      }

      if (empty($data['phone'])) {
        $data['phone_err'] = 'Kérem adjon meg telefonszámot';
      }

      if (empty($data['country'])) {
        $data['country_err'] = 'Kérem adjon meg országot';
      }

      if (empty($data['zip'])) {
        $data['zip_err'] = 'Kérem adjon meg irányítószámot';
      }

      if (empty($data['city'])) {
        $data['city_err'] = 'Kérem adjon meg várost';
      }

      if (empty($data['street'])) {
        $data['street_err'] = 'Kérem adjon meg utcát';
      }

      if (empty($data['s_number'])) {
        $data['s_number_err'] = 'Kérem adjon meg házszámot';
      }



      $emailB = filter_var($data['email'], FILTER_SANITIZE_EMAIL);

      if (
        filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
        $emailB != $data['email']
      ) {
        $data['email_err2'] = 'A megadott email cím nem helyes!';
      }

      if (!preg_match('/^((?:[03])6)?(?(?=([237]0|1))([237]0|1)(\d{7})|(2[2-9]|3[2-7]|4[024-9]|5[234679]|6[23689]|7[2-9]|8[02-9]|9[92-69])(\d{6}))$/', $data['phone'])) {
        $data['phone_err2'] = 'A megadott telefonszám érvénytelen!';
      }



      if (
        empty($data['name_err'])  && empty($data['email_err'])  && empty($data['phone_err'])  && empty($data['email_err2'])  && empty($data['phone_err2']) && empty($data['country_err']) && empty($data['zip_err']) && empty($data['city_err'])
        && empty($data['street_err']) && empty($data['s_number_err'])
      ) {

        if ($this->postModel->addPost($data)) {

          redirect('pages/index');
        } else {
          die('Something went wrong');
        }
      } else {


        $posts = $this->postModel->getPosts();
        $data = [
          'posts' => $posts,
          'name_err' =>  $data['name_err'],
          'email_err' => $data['email_err'],
          'email_err2' => $data['email_err2'],
          'phone_err' => $data['phone_err'],
          'phone_err2' => $data['phone_err2'],
          'country_err' =>  $data['country_err'],
          'zip_err' =>  $data['zip_err'],
          'city_err' =>  $data['city_err'],
          'street_err' =>  $data['city_err'],
          's_number_err' => $data['s_number_err']
        ];
        $this->view('pages/index', $data);
      }
    } else {
      $this->view('pages/index', $data);
    }
  }
}
