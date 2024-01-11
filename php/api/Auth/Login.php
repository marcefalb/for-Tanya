<?php

require '../../database/db.php';
require '../../libs/generateRandomString.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$user = R::findOne( 'users', ' login = ?', [ $_POST['login']);

if ($user && $_POST['password'] === $user->password) {
  $token = generateRandomString(15);

  $auth = R::dispense('auth');
  $auth->token = $token;
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
