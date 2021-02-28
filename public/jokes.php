<?php
try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$result = findAll($conect_sql, 'joke');

/*
function findById($conect_sql, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';
*/

	$jokes = [];
	foreach ($result as $joke) {
		$author = findById($conect_sql, 
			'author', 'id',
			$joke['authorId']);
			$jokes[] = [
				'id' => $joke['id'],
				'joketext' => $joke['joketext'],
				'jokedate' => $joke['jokedate'],
				'name' => $author['name'],
				'email' => $author['email']
];
}


$title = 'Lista chistes';

$totalJokes =  total($conect_sql, 'joke');

ob_start();
include __DIR__ .'/../templates/jokes.html.php';
$output = ob_get_clean();
}
catch (PDOException $e) {
$output = 'No se logro conectar:' . $e->getMessage(). ' en ' .
$e->getFile() . ': en la linea ' . $e->getLine();;	
}

include __DIR__ . '/../templates/layout.html.php';


