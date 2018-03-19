<?php 
	require './backend/helpers.php';

	session_start();
	session_regenerate_id();

	if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
		header('Location: /');
	}

	$user = $_SESSION['user'];

	if (!allSetted($user, ['first', 'last', 'email'])) {
		header('Location: /backend/session_destroy.php');
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title> Dashboard ::
		<?php echo $user['first']; ?> </title>

	<link rel="stylesheet" href="/brostv/css/master.css">
	<link rel="stylesheet" href="/brostv/css/welcome.css">
</head>

<body id="top">
	<div class="hero-container welcome-screen">
		<div class="welcome-content">
			<p class="welcome-title"> Benvenuto in
				<b>BrosTV</b>
				<br />
				<?php echo $user['first']; ?> </p>
			<div class="welcome-buttons">
				<a href="#discover" class="btn outline">scopri</a>
				<a href="/brostv/prenota.php" class="btn">prenota</a>
			</div>
		</div>
	</div>
	<div id="discover" class="hero-container welcome-screen center">
		<div>
			<h1> OOPS! Ancora niente da vedere! </h1>
			<a href="#top" class="btn outline"> Torna su </a>
		</div>
	</div>

	<a href="/backend/session_destroy.php" class="logout">logout</a>

	<script src="/brostv/js/axios.min.js"></script>
	<script src="/brostv/js/jquery.min.js"></script>

	<script src="/brostv/js/index.js"></script>
	<script src="/brostv/js/song.js"></script>
</body>

</html>