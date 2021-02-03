<?php
try {
//$pdo = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION','SiViNSalta',
//	'@#sivin#@salta!%2020&&');
$pdo = new PDO('mysql:host=localhost;dbname=ijdb','ijdbuser','enFI762%');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$output = 'Se conecto correctamente';
}
catch (PDOExeption $e) {
$output = 'No se logro conectar' . $e;	
}
include __DIR__ . '/../templates/output.html.php';


