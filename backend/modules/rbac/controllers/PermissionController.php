<?php

namespace rbac\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\rbac;
use rbac\models\AuthItem;
use rbac\models\AuthItemSearch;
use rbac\models\AuthItemChild;
use yii\filters\VerbFilter;

/**
 * Class PermissionController
 * Controls permissions
 * @package app\modules\rbac\controllers
 */
class PermissionController extends Controller
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
     * Show permissions
     * @return string
     */
    public function actionIndex(){
        $searchModel = new AuthItemSearch(['type' => AuthItem::TYPE_PERMISSION]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Create permissions
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AuthItem(['scenario' => AuthItem::SCENARIO_PERMISSION]);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->type = AuthItem::TYPE_PERMISSION;
            if(!$model->save()) {
                Yii::error('Permission not created: ' .var_export($model->getErrors(),TRUE),__METHOD__);
            }

            return $this->redirect('index');
        } else {
            return $this->render('create',[
                'model' => $model
            ]);
        }
    }

    /**
     * Update permissions
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionUpdate($name)
    {
        /** @var AuthItem $model select permission */
        $model = AuthItem::findOne($name);
        $model->scenario = AuthItem::SCENARIO_PERMISSION;
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save())
                Yii::error('Permission not updated: ' .var_export($model->getErrors(),TRUE),__METHOD__);

            return $this->redirect('index');
        } else {
            return $this->render('update',[
                'model' => $model
            ]);
        }
    }

    /**
     * Delete permissions
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDelete($name)
    {
        /** @var AuthItem $model select permission */
        $model = AuthItem::findOne($name);
        if(!$model->delete()){
            Yii::error('Permission not deleted: ' .var_export($model->getErrors(),TRUE),__METHOD__);
        }
        return $this->redirect('index');
    }

    /**
     * Add/Remove relation between role and permission
     * @throws HttpException
     * @throws \Exception
     */
    public function actionChangePermission(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        if (!$request->isAjax)
            throw new ForbiddenHttpException('Access denied');

        $role = $request->post()['role'];
        $permission = $request->post()['permission'];

        if(empty($role) || empty($permission))
            throw new NotFoundHttpException('Missing obligatory values');

        /** @var AuthItemChild $assignment search this relation */
        $assignment = AuthItemChild::findOne(['parent'=>$role,'child'=>$permission]);

        if(is_null($assignment)){
            $role_m = AuthItem::findOne($role);
            $permission_m = AuthItem::findOne($permission);
            if(!empty($role_m) && !empty($permission_m)){
                $child_m = new AuthItemChild();
                $child_m->parent = $role;
                $child_m->child = $permission;
                if($child_m->save())
                    $response->data = ['status' => 200,'massage'=>'Relation added'];
                else
                    Yii::error(var_export($child_m->getErrors(), TRUE), __METHOD__);
            }
        }else{
            if($assignment->delete())
                $response->data = ['status' => 200,'massage'=>'Relation deleted'];
        }
    }
}
