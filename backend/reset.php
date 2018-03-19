<?php
require '_config.php';

	$conn->query('UPDATE `week_days` SET fascia1=NULL AND fascia2=NULL');
	header('location: /');
