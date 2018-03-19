<?php 
	session_start();
	session_regenerate_id();

	session_unset();
	session_destroy();

	header('Location: /');
