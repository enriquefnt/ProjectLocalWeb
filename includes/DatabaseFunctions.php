
<?php
include_once __DIR__ .'/../includes/DatabaseConnection.php';

function total($conect_sql, $table) {
	$query = query($conect_sql, 'SELECT COUNT(*) FROM `' . $table . '`');
	$row = $query->fetch();
	return $row[0];
}


function query($conect_sql,  $sql, $parameters = []) {
	$query = $conect_sql->prepare($sql);
	$query->execute($parameters);
	return $query;
}

function findById($conect_sql, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';

	$parameters = [
		'value' => $value
	];

	$query = query($conect_sql, $query, $parameters);

	return $query->fetch();
}



function getJoke($conect_sql, $id) {
	$parameters = [':id' => $id];
	$query = query($conect_sql, 'SELECT * FROM `joke`
						WHERE `id` = :id', $parameters);
	return $query->fetch();
}



function delete($conect_sql, $table, $primaryKey, $id ) {
	$parameters = [':id' => $id];

	query($conect_sql, 'DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = :id', $parameters);
}



function findAll($conect_sql, $table) {
	$result = query($conect_sql, 'SELECT * FROM `' . $table . '`');

	return $result->fetchAll();
}


function insert($conect_sql, $table, $fields) {
	$query = 'INSERT INTO `' . $table . '` (';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');

	$query .= ') VALUES (';


	foreach ($fields as $key => $value) {
		$query .= ':' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ')';

	$fields = processDates($fields);

	query($conect_sql, $query, $fields);
}



	function update($conect_sql, $table, $primaryKey, $fields) {

	$query = ' UPDATE `' . $table .'` SET ';


	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ' WHERE `' . $primaryKey . '` = :primaryKey';

	//Set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];

	$fields = processDates($fields);

	query($conect_sql, $query, $fields);
}


function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}

	return $fields;
}

function save($pdo, $table, $primaryKey, $record) {
	try {
		if ($record[$primaryKey] == '') {
			$record[$primaryKey] = null;
	}
	insert($pdo, $table, $record);
	}
	catch (PDOException $e) {
		update($pdo, $table, $primaryKey, $record);
	}
}

