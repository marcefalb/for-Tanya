<?php

require '../../database/db.php';
require '../../libs/generateRandomString.php';

$login = 'autoservice_admin';
$password = 'admin12345';

$_POST = json_decode(file_get_contents('php://input'), true);

if ($login === $_POST['login'] && $password === $_POST['password']) {
  $token = generateRandomString(15);

  $auth = R::dispense('authorization');
  $auth -> token = $token;
  R::store($auth);

  echo json_encode($response = array(
    'auth' => true,
    'token' => $token,
  ));
}
else {
  echo json_encode($response = array(
    'auth' => false,
  ));
}