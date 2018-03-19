<?php 
	require './backend/helpers.php';
	require './backend/_config.php';

	session_start();
	session_regenerate_id();

	if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
		header('Location: /');
	}

	$user = $_SESSION['user'];

	if (!allSetted($user, ['first', 'last', 'email'])) {
		header('Location: /backend/session_destroy.php');
	}

	$db = $conn->query('SELECT * FROM `week_days`');
	$weekDays = $db->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title> Dashboard ::
		<?php echo $user['first']; ?> </title>

	<link rel="stylesheet" href="/css/master.css">
	<link rel="stylesheet" href="/css/prenota.css">
</head>

<body>
	<div class="hero-container center">
		<div class="card-container">
			<?php if (isset($weekDays) && count($weekDays) > 0): ?>
			<?php foreach ($weekDays as $day): ?>
			<div data-dayid="<?php echo $day['id'] ?>" title="<?php echo ($day['fascia1'] != null) ? $day['fascia1'] : '' ?> - <?php echo ($day['fascia2 '] != null) ? $day['fascia2 '] : '' ?>"
			 class="card <?php echo ($day['fascia1'] != null || $day['fascia2'] != null) ? 'taken' : '' ?>">
				<?php echo $day['name'][0] ?> </div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<div class="bottom-container">
			<div class="close">&times;</div>
			<h4 class="bottom-title">fascia oraria</h4>
			<form action="/backend/prenotation_handler.php">
				<input type="hidden" name="day" value="1" id="dayid">

				<div id="fascie-orarie">
					<!-- // FASCIA 1 -->
					<input id="fascia1" type="radio" name="fascia" value="1">
					<label for="fascia1" class="btn fascia-oraria outline">19:30 - 21:30</label>

					<!-- // FASCIA 2 -->
					<input id="fascia2" type="radio" name="fascia" value="2">
					<label for="fascia2" class="btn fascia-oraria outline">21:30 - 00:00</label>
				</div>
				<input type="submit" class="btn" value="PRENOTA">
			</form>
		</div>
	</div>
	<a href="/backend/session_destroy.php" class="logout">logout</a>

	<script src="/js/axios.min.js"></script>
	<script src="/js/jquery.min.js"></script>

	<script src="/js/index.js"></script>
	<script src="/js/song.js"></script>
	<script src="/js/prenota.js"></script>
</body>

</html>