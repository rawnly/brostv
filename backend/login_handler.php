<?php

require '_config.php';
require 'helpers.php';

if (isset($_POST['req-type'])) {
	$type = $_POST['req-type'];

	if ($type == 'sign-in') {
		if (!allSetted($_POST, ['email', 'pass'])) {
			die('Missing an input. Try Again');
		}

		$db = $conn->prepare('SELECT * FROM `users` WHERE email=:e AND password=:p');
		$res = $db->execute([
			':e' => $_POST['email'],
			':p' => sha1($_POST['pass'])
		]);

		if ($res) {
			if ($db->rowCount() == 1) {
				$row = $db->fetch(PDO::FETCH_ASSOC);

				session_start();
				session_regenerate_id();

				$_SESSION['logged'] = true;
				$_SESSION['user'] = [
					'first' => $row['first'],
					'last' => $row['last'],
					'email' => $row['email'],
				];

				header('Location: /home.php');
			}

			die('Questo utente non esiste. <a href="/?register"> Registrati qui </a>');
		}

		throw $res->errorInfo();
	} elseif ($type == 'sign-up') {
		if (!allSetted($_POST, ['first_name', 'last_name', 'email', 'pass'])) {
			die('Manca qualche parametro! Riprova!');
		}

		$db = $conn->prepare('INSERT INTO `users` (first, last, email, password) VALUES (:f, :l, :e, :p)');
		$res = $db->execute([
			':f' => $_POST['first_name'],
			':l' => $_POST['last_name'],
			':e' => $_POST['email'],
			':p' => sha1($_POST['pass']),
		]);

		if ($res) {
			header('Location: /');
			return;
		}

		throw $res->errorInfo();
	} else {
		header('Location: /');
	}
}
