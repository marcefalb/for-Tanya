<?php

require '../../database/db.php';

$token = $_COOKIE['token'] ? null;

$authItem = R::findOne( 'auth', ' token = ?', [ $token ]);

if ($authItem) {
  return json_encode($response = [
    'auth' => true,
  ]);
}
else {
  return json_encode($response = [
    'auth' => false,
  ]);
}
