<?php
namespace app\models;

use app\base\Model;

class Groups extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->tableName = 'groups';
	}

	public function testing($data)
	{
		$result = 0;
		if($this->insert($data))
		{
			$result = 1;
		}
		return $result;
	}
	
}



?>