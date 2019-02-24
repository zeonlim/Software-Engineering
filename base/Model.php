<?php
namespace app\base;

class Model
{
	public $conn;

	public $host = 'localhost';
	public $user = 'root';
	public $pass = '';
	public $name = 'breath_app';
	public $tableName = "";

	public function __construct()
	{ 
		
		try {
			$this->conn = new \PDO(
				"mysql:host=" . $this->host . ";dbname=" . $this->name . "", 
				$this->user, 
				$this->pass
			);
			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}


	public function getAll()
	{
		try {

			$sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{

				$rows[] = $row;
			}
			return $rows;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function getOne($id)
	{
		try {

			$sql  = "SELECT * FROM user WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id' => $id]);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}


	public function getOneBy($data)
	{
		try {
			$conn = $this->conn;
			$sql  = "SELECT * FROM $this->tableName WHERE 1";
			foreach ($data as $key => $value) {
				$sql.= " AND `$key` = :$key";
			}
			$stmt = $this->conn->prepare($sql);
			$stmt->execute($data);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;	
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function insert($data)
	{
		try {

			$sql  = "INSERT INTO $this->tableName (";
			foreach ($data as $key => $value) {
				$sql .= " `$key` ,";
			}
			$sql = rtrim($sql,',');
			$sql .= ") VALUES (";
			foreach ($data as $key => $value) {
				
				$sql .= " :$key ,";
			}

			$sql = rtrim($sql,',');
			$sql .= ")";
			$stmt = $this->conn->prepare($sql);
			return $stmt->execute($data);

		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function update($id,$data)
	{
		try {

			$sql = "UPDATE $this->tableName SET";
			foreach ($data as $key => $value) {
				$sql.= " $key = '$value',";
			}
			
			$sql = rtrim($sql,',');
			$sql .= " WHERE id=$id";
			$stmt = $this->conn->prepare($sql);
			$data = array_merge(['id' => $id], $data);
			return $stmt->execute($data);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function delete($id)
	{
		try {

			$sql = "DELETE FROM $this->tableName WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			return $stmt->execute(['id' => $id]);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	
}