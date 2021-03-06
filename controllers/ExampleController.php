<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Example;

class ExampleController extends Controller
{
	public function actionIndex()
	{
		$model = new Example;
		$users = $model->getAll();
		return $this->render('index', ['users' => $users]);
	}

	public function actionCreate()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Example;
			$model->insert(['name' => $_POST['name']]);
		}
		return $this->render('form');
	}

	public function actionAjax()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Example;
			$model->insert(['name' => $_POST['name']]);
		}
		return $this->render('form-ajax');
	}

	public function actionAjaxGetUser()
	{
		$model = new Example;
		$users = $model->getAll();
		header('Content-Type: application/json');
		echo json_encode($users);
	}

	public function actionAjaxCreateUser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Example;
			$lastId = $model->insert(['name' => $_POST['name']]);
			$user = $model->getOne($lastId);
			header('Content-Type: application/json');
			echo json_encode($user);
		}
	}

	public function actionAjaxUpdateUser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Example;
			$id = $_GET['id'];
			$model->update($id, ['name' => $_POST['name']]);
			$user = $model->getOne($id);
			header('Content-Type: application/json');
			echo json_encode($user);
		}
	}

	public function actionAjaxDeleteUser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id']))
		{
			$model = new Example;
			$lastId = $model->delete($_GET['id']);
			header('Content-Type: application/json');
			echo json_encode(['id' => $_GET['id']]);
		}
	}
}