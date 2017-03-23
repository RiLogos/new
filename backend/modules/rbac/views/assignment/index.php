<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
use rbac\models\AuthAssignment;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $roles */

$this->title = 'User assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width'=>'60px']
            ],
            [
                'attribute' => 'username',

            ],
            [
                'attribute' => 'Roles',
                'format' => 'raw',
                'options' => ['width'=>'400px'],
                'filter' =>  $roles,
                'value' => function ($model)use($roles) {
                    return Select2::widget([
                        'name' => 'role_'.$model->id,
                        'id' => 'id_'.$model->id,
                        'value' => AuthAssignment::getAssignment($model->id),
                        'data' => $roles,
                        'options' => [
                            'multiple' => true,
                            'placeholder' => 'Select roles...',
                            'onchange' => '$.post("'.Url::toRoute(['change-assignment']).'", {"id":"'.$model->id.'","role":$(this).val()})',
                        ]
                    ]);
                }
            ]
        ],
    ]);
    ?>
</div>
