<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

	try {
		if (isset($_POST['joketext'])) {
			
		update($conect_sql, 'joke', 'id', ['id' => $_POST['jokeid'],
						  'joketext' => $_POST['joketext'], 
						  'authorId' => 1]);

		header('location: jokes.php');
		} 
		else {
		$joke = findById($conect_sql, 'joke', 'id', $_GET['id']);

		$title = 'Editar Chiste';
		
		ob_start();
include __DIR__ . '/../templates/editjoke.html.php';
		$output = ob_get_clean();
		} 
	}
	catch (PDOException $e) {
		$output = 'No se logro conectar:' . $e->getMessage(). ' en ' .
		$e->getFile() . ': en la linea ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';

