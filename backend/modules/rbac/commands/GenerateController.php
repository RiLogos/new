<?php

namespace rbac\commands;

use yii\console\Controller;

use rbac\models\Generate;
use rbac\models\AuthAssignment;

/**
 * Class GenerateController
 * @package app\commands
 */
class GenerateController extends Controller
{
    /**
     *  Generate rbac
     */
    public function actionIndex()
    {
        $authAssignment = AuthAssignment::find()->asArray()->all();

        if(empty($authAssignment))
            $authAssignment = [
                ['user_id' => 1, 'item_name' => 'Admin', 'created_at' => time()]
            ];

        $generate = new Generate();
        $generate->import();

        $model = new AuthAssignment();

        /** @var array $assignment */
        foreach ($authAssignment as  $assignment){

            $model->setAttributes($assignment);

            if(!$model->save())
                print_r($model->getErrors());
        }
    }
}
