<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Users;

class UsersController extends Controller
{
	public function actionIndex()
	{
		$model = new Users;
		$testings = $model->forgotPassword('zeon@inspiren.my',6689021312);
		/*$testings = $model->testing(3,[
			'name' =>  'zann'
		]);*/
		return $this->render('index' , [
			'testings' => $testings,
		]);
	}

	public function actionCreate()
	{
		return $this->render('form');	
	}


	public function actionAjaxCreateUser()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model   = new Users;
			$user = $model->register([
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'password' => $_POST['password'],
				'phone' => $_POST['phone']
			]);
			header('Content-Type:application/json');
			echo json_encode($user);

		}
	}

}



?>