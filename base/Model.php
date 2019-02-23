<?php
namespace app\base;

class Model
{
	public $conn;

	public $host = 'localhost';
	public $user = 'root';
	public $pass = '';
	public $name = 'breath_app';

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
}