<?php
	session_start();
	session_regenerate_id();

	require '_config.php';
	require 'helpers.php';

	$db = $conn->query('SELECT * FROM `week_days`');
	$rows = $db->fetchAll();

	echo json_encode($rows);
