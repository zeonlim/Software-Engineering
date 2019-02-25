<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Groups;

class GroupsController extends Controller
{
	public function actionIndex()
	{
		$model = new Groups;
		$data = $model->testing([
			'title'       => 'asdasd',
			'userID'      => 1,
			'memberID'    => 2,
			'create_date' => '21-12-12',
		]);
		return $this->render('index',[
			'data' => $data
		]);
	}

	
}



?>