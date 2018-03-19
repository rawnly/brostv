<?php 
	require '_config.php';
	require 'helpers.php';

	session_start();
	session_regenerate_id();

	$user = $_SESSION['user'];
	$day = $_POST['day'];
	$fascia = 'fascia' . $_POST['fascia'];

	$db = $conn->prepare('SELECT * FROM `week_days` WHERE id=:day');
	$res = $db->execute([
		':day' => $day
	]);

	if ($res) {
		if ($db->rowCount() == 1) {
			$sql = "UPDATE `week_days` SET $fascia=:fascia WHERE id=:day";
			$db = $conn->prepare($sql);
			$res = $db->execute([
				':day' => $day,
				':fascia' => $user['first']
			]);

			echo json_encode([
				'status' => $res,
				'error' => $db->errorInfo()
			]);
		}
	}
