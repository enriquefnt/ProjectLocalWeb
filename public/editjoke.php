<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

	try {
	if (isset($_POST['joke'])) {
		
			$joke = $_POST['joke'];
			$joke['jokedate'] = new DateTime();
			$joke['authorId'] = 1;
			
			save($conect_sql, 'joke', 'id', $joke);
			
			header('location: jokes.php');  

	}
	else {

		if (isset($_GET['id'])) {
			$joke = findById($conect_sql, 'joke', 'id', $_GET['id']);
		}

		$title = 'Editar chiste';

		ob_start();

		include  __DIR__ . '/../templates/editjoke.html.php';

		$output = ob_get_clean();
	}
}
	catch (PDOException $e) {
		$output = 'No se logro conectar:' . $e->getMessage(). ' en ' .
		$e->getFile() . ': en la linea ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';

