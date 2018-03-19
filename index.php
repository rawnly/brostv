<?php 
	session_start();

	if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		header('Location: /home.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title> </title>

	<link rel="stylesheet" href="/css/master.css">
</head>

<body>
	<div class="hero-container main center">
		<form action="/backend/login_handler.php" method="POST" class="hero-form">
			<?php if (isset($_GET['register'])): ?>

			<input name="req-type" type="hidden" value="sign-up" />

			<div class="form-group">
				<input class="form-input" type="text" placeholder="Nome" name="first_name">
			</div>
			<div class="form-group">
				<input class="form-input" type="text" placeholder="Cognome" name="last_name">
			</div>
			<div class="form-group">
				<input class="form-input" type="email" placeholder="Email" name="email">
			</div>
			<div class="form-group">
				<input class="form-input" type="password" placeholder="Password" name="pass">
				<p>Già registrato?
					<a href="/">Clicca qui!</a>
				</p>
			</div>

			<input type="submit" value="Registrati">

			<?php else: ?>

			<input name="req-type" type="hidden" value="sign-in" />

			<div class="form-group">
				<input class="form-input" type="email" placeholder="Email" name="email">
			</div>
			<div class="form-group">
				<input class="form-input" type="password" placeholder="Password" name="pass">
				<p>Non sei ancora registrato?
					<a href="/?register">Clicca qui!</a>
				</p>
			</div>

			<input type="submit" value="Entra">

			<?php endif ?>
		</form>

	</div>

	<script src="/js/axios.min.js"></script>
	<script src="/js/jquery.min.js"></script>

	<script src="/js/index.js"></script>
</body>

</html>