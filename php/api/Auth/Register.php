<?php

require '../../database/db.php';
require '../../libs/generateRandomString.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$hasUser = R::findOne( 'users', ' login = ?', [ $_POST['login']);

if (!$hasUser) {
  $token = generateRandomString(15);

  $user = R::dispense('users');
  $user->login = $_POST['login'];
  $user->password = $_POST['password'];
  R::store($auth);

  return json_encode($response = [
    'auth' => true,
    'token' => $token,
  ]);
} else {
  return json_encode($response = [
    'auth' => false,
  ]);
}
