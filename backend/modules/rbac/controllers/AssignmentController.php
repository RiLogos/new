<?php

namespace rbac\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use rbac\models\AuthAssignment;
use rbac\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * Class AssignmentController
 * Assignment role to user
 * @package app\modules\rbac\controllers
 */
class AssignmentController extends Controller
{
    /**
     * Show users and their roles
     * @return string
     */
    public function actionIndex(){

        $module = \Yii::$app->controller->module->userClass;

        $query = $module::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $roles = ArrayHelper::map(AuthItem::findAll(['type'=>AuthItem::TYPE_ROLE]),'name','name');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'roles' => $roles,
        ]);
    }

    /**
     * Add/Delete relations between role and user
     * @throws HttpException
     * @throws \Exception
     */
    public function actionChangeAssignment(){
        $module = \Yii::$app->controller->module->userClass;

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        if (!$request->isAjax)
            throw new ForbiddenHttpException('Access denied');

        $user = $request->post()['id'];
        $roles = $request->post()['role'];

        if((empty($roles) || !is_array($roles)) || (empty($user) && $module::findIdentity($user)))
            throw new NotFoundHttpException('Missing obligatory values');

        /** @var AuthAssignment $assignment remove relations*/
        AuthAssignment::deleteAll(['user_id'=>$user]);

        foreach ($roles as $role) {
            $new_assignment = new AuthAssignment();
            $new_assignment->item_name = $role;
            $new_assignment->user_id = $user;
            if($new_assignment->save())
                $response->data = ['status' => 200,'massage'=>'Relations changed'];
            else
                Yii::error(var_export($new_assignment->getErrors(), TRUE), __METHOD__);
        }
    }

    /**
     * Change role
     */
    public function actionChangeRole()
    {
        $module = \Yii::$app->controller->module->userClass;

        AuthAssignment::deleteAll();

        /** @var $module $users */
        $users = $module::find()->with('profile')->where(['status'=>[$module::STATUS_ACTIVE,$module::STATUS_NOT_ACTIVE]])->all();
        foreach ($users as $user) {
            $new_assignment = new AuthAssignment();
            $new_assignment->item_name = 'user';

            $new_assignment->user_id = (string)$user->id;
            if(!$new_assignment->save()){
                Yii::error(var_export($new_assignment->getErrors(), TRUE), __METHOD__);
            }
        }
    }
}
