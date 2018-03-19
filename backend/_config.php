<?php

$_POST = array_filter($_POST);
$_GET = array_filter($_GET);

try {
	$conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=bros_tv', 'root', 'toor');
} catch (PDOException $e) {
	throw $e;
}
