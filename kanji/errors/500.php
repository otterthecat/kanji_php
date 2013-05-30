<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
	</head>

	<body>

		<section>
			<h1>Error [<?php echo $errno; ?>]</h1>
			<h2>What:</h2>
			<p>
				<?php echo $errstr; ?> in class '<?php echo get_class($this); ?>'
			</p>
			
			<h2>Where:</h2>
			<p>
				Line <?php echo $errline." in ".$errfile; ?>
			</p>
		</section>

		<footer>
		</footer>
	</body>
</html>