<?php
namespace app\models;

use app\base\Model;

class User extends Model
{
	public $tableName ='user';
	
	public function insert($data)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			INSERT INTO $this->tableName SET
				name = :name
		");
		return $stmt->execute($data) ? $conn->lastInsertId() : false;
	}

	public function update($id, $data)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			UPDATE $this->tableName SET
				name = :name
			WHERE id = :id
		");
		return $stmt->execute(array_merge(['id' => $id], $data)) ? $conn->lastInsertId() : false;
	}

	public function getOne($id)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			SELECT * 
			FROM $this->tableName 
			WHERE id = :id
		");
		$stmt->execute(['id' => $id]);
		return $stmt->fetch();
	}

	public function getOneBy($data)
	{
		$conn = $this->conn;
		$sql = "
			SELECT * 
			FROM $this->tableName 
			WHERE 1
		";
		foreach ($data as $key => $value) $sql .= "AND `$key` = :$key";
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getAll()
	{

		$conn = $this->conn;
		$sql = "
			SELECT * 
			FROM $this->tableName
		";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$rows = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
		{
			$rows[] = $row;
		}

		return $rows;
	}

	public function getAllBy($data)
	{
		$conn = $this->conn;
		$sql = "
			SELECT * 
			FROM $this->tableName
			WHERE 1 
		";
		foreach ($data as $key => $value) $sql .= "AND `$key` = :$key";
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		$rows = [];
		while ($row = $stmt->fetchAll(\PDO::FETCH_ASSOC))
		{
			$rows[] = $row;
		}
		return $rows;
	}

	public function delete($id)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			DELETE FROM $this->tableName 
			WHERE id = :id
		");
		$stmt->execute(['id' => $id]);
	}
	
}


?>