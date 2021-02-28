<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="jokes.css" type="text/css">
		<title><?=$title?></title>
	</head>
	<body>
		<header>
			<h1>Base de Chistes</h1>
		</header>
		<nav>
			<ul>
				<li>
					<a href="index.php">Inicio</a>
				</li>
				<li>
					<a href="jokes.php">Chistes</a>
				</li>
				<li>
					<a href="addjoke.php">Agregar chiste</a>
				</li>
			</ul>
		</nav>
		<main>
			<?=$output?>
		</main>
		<footer>
			&copy; BDCI <?=date('Y')-1?>;
			<p>Autores varios</p>
		</footer>
	</body>
</html>