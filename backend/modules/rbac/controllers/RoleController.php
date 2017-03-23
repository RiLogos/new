<?php

namespace rbac\controllers;

use Yii;
use yii\web\Controller;
use yii\rbac;
use rbac\models\AuthItem;
use rbac\models\AuthItemSearch;
use yii\filters\VerbFilter;

/**
 * Class RoleController
 * Controls roles
 * @package app\modules\rbac\controllers
 */
class RoleController extends Controller
{
	
	/**
	 * List behaviors
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'Delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Show roles
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new AuthItemSearch(['type' => AuthItem::TYPE_ROLE]);
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Show role
	 * @param $name
	 * @return string
	 */
	public function actionView($name)
	{
		//get role
		$model = AuthItem::findOne($name);

		$searchPermission = new AuthItemSearch(['type' => AuthItem::TYPE_PERMISSION]);
		$dataPermission = $searchPermission->search(Yii::$app->request->queryParams);

		return $this->render('view', [
			'model' => $model,
			'searchPermission' => $searchPermission,
			'dataPermission' => $dataPermission,
		]);
	}

	/**
	 * Create role
	 * @return string|\yii\web\Response
	 */
	public function actionCreate()
	{
		$model = new AuthItem(['scenario' => AuthItem::SCENARIO_ROLE]);

		if ($model->load(Yii::$app->request->post())) {
			$model->type = AuthItem::TYPE_ROLE;
			if (!$model->save())
				Yii::error('Role not created: ' . var_export($model->getErrors(), TRUE), __METHOD__);

			return $this->redirect('index');
		} else {
			return $this->render('create', [
				'model' => $model
			]);
		}
	}

	/**
	 * Edit role
	 * @param $name
	 * @return string|\yii\web\Response
	 */
	public function actionUpdate($name)
	{
		/** @var AuthItem $model select role */
		$model = AuthItem::findOne($name);
		$model->scenario = AuthItem::SCENARIO_PERMISSION;
		if ($model->load(Yii::$app->request->post())) {
			if (!$model->save())
				Yii::error('Role not updated: ' . var_export($model->getErrors(), TRUE), __METHOD__);

			return $this->redirect('index');
		} else {
			return $this->render('update', [
				'model' => $model
			]);
		}
	}

	/**
	 * Delete role
	 * @param $name
	 * @return \yii\web\Response
	 */
	public function actionDelete($name)
	{
		/** @var AuthItem $model select role */
		$model = AuthItem::findOne($name);
		if (!$model->delete())
			Yii::error('Role not deleted: ' . var_export($model->getErrors(), TRUE), __METHOD__);

		return $this->redirect('index');
	}
}
