<?php
namespace app\models;

use app\base\Model;

class Users extends Model
{

	public function testing($data)
	{
		echo $data;
	}

	public function getAll()
	{
		$conn = $this->conn;
		$sql = "SELECT * from user";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$rows = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
		{

			$rows[] = $row;
		}
		return $rows;
	}

	public function getOne($id)
	{
		$conn = $this->conn;
		$sql  = "SELECT * from user Where id = :id";
		$stmt = $conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$rows = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
		{
			$rows[] = $row;
		}
		return $rows;
	}

	public function getOneBy($data)
	{
		$conn = $this->conn;
		$sql  = "SELECT * from user Where 1";
		foreach ($data as $key => $value) {
			$sql.= " AND `$key` = :$key";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		$rows = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
		{
			$rows[] = $row;
		}
		return $rows;	
	}
	public function insert($data)
	{
		$conn = $this->conn;
		$data['password'] = md5(uniqid("activecode"),true);

		$sql  = "INSERT INTO user (";
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
		$stmt = $conn->prepare($sql);
		return $stmt->execute($data);

	}

	public function update($id, $data)
	{

		$conn = $this->conn;
		$sql = "UPDATE user SET";
		foreach ($data as $key => $value) {
			$sql.= " $key=':$value',";
		}
		
		$sql = rtrim($sql,',');
		$sql .= " WHERE id=$id";
		$stmt = $conn->prepare($sql);
		$data = array_merge(['id' => $id], $data);
		return $stmt->execute($data);
	}

	public function delete($id)
	{

		$conn = $this->conn;
		$sql = "DELETE FROM user WHERE id = :id";
		$stmt = $conn->prepare($sql);
		return $stmt->execute(['id' => $id]);
	}
	
	public function forgotPassword($email,$password)
	{
		$conn = $this->conn;
		$result = 0;
		$users = $this->getOneBy([
			'email' => $email
		]);

		if( $users )
		{
			foreach ($users as $user ) {
				$this->update( $user['id'],[
					'password' => $password,
					'name' => 'kaisen',
				]);
			}	
			
			$result = 1;
		}
		
		return $result;
	}
	public function register($data)
	{
		
		$conn = $this->conn;
		$result = 0;
		$status = $this->getOneBy([
			'email' => $data['email']
		]);

		if( !$status )
		{
			$this->insert($data);
			$result = 1;
		}
		
		return $result;
	}
	
}



?>