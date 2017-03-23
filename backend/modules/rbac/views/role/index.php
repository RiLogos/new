<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrators Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summaryOptions' => ['class' => 'text-right'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'options' => ['width'=>'240px'],
                'value' => function ($data) {
                    return Html::a($data->name , Url::to(['view', 'name' => $data->name]));
                },
            ],
            'description:ntext',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php: Y-m-d'],
                'options' => ['width'=>'200px']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php: Y-m-d'],
                'options' => ['width'=>'200px']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['view', 'name' => $model->name]));
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['update', 'name' => $model->name]));
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::toRoute(['delete', 'name' => $model->name]));
                    },
                ]
            ],
        ],
    ]); ?>

</div>