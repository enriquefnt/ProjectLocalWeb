<?php
if (isset($_POST['joketext'])) {
try {

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';


insert($conect_sql, 'joke',
				 ['authorId' => 3, 
				 'jokeText' => $_POST['joketext'],
				  'jokedate' => new DateTime()]);

header('location: jokes.php');

}
	catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in '
	. $e->getFile() . ':' . $e->getLine();
}
}
else {
$title = 'Agregue su chiste';

ob_start();

include __DIR__ . '/../templates/addjoke.html.php';

$output = ob_get_clean();

}
include __DIR__ . '/../templates/layout.html.php';


