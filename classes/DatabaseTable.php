<?php
class DatabaseTable
{
class DatabaseTable {
public $pdo;
public $table;
public $primaryKey;
}


public function total($pdo, $table) {
	$query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
	$row = $query->fetch();
	return $row[0];
}


private function query($pdo,  $sql, $parameters = []) {
		$query = $this->pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}

public function findById($pdo, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';

	$parameters = [
		'value' => $value
	];

	$query = query($pdo, $query, $parameters);

	return $query->fetch();
}



public function delete($pdo, $table, $primaryKey, $id ) {
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = :id', $parameters);
}



public function findAll($pdo, $table) {
		$result = $this->query('SELECT *FROM ' . $this->table);
	return $result->fetchAll();
}


private function insert($pdo, $table, $fields) {
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

	query($pdo, $query, $fields);
}



	public function update($pdo, $table, $primaryKey, $fields) {

	$query = ' UPDATE `' . $table .'` SET ';


	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ' WHERE `' . $primaryKey . '` = :primaryKey';

	//Set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}


private function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}

	return $fields;
}

public function save($pdo, $table, $primaryKey, $record) {
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

}