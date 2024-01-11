<?php

require '../../database/db.php';

if ($_COOKIE['token']) {
  $token = $_COOKIE['token'];

	$authItem = R::findOne( 'auth', ' token = ?', [ $token ]);

	if ($authItem && $token) {
		return json_encode($response = [
			'auth' => true,
		]);
	} else {
		return json_encode($response = [
			'auth' => false,
		]);
	}
}

