<?php
try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

delete($conect_sql, 'joke', 'id', $_POST['id']);

  header('location: jokes.php');
}
catch (PDOException $e) {
$output = 'No se logro conectar:' . $e->getMessage(). ' en ' .
$e->getFile() . ': en la linea ' . $e->getLine();;	
}

include  __DIR__ . '/../templates/layout.html.php';