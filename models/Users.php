<?php
namespace app\models;

use app\base\Model;

class Users extends Model
{


	public function __construct()
	{
		parent::__construct();

		$this->tableName = 'user';
	}


	public function testing($id)
	{
		return parent::delete($id);
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