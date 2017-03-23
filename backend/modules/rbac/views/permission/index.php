<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrators Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create permission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summaryOptions' => ['class' => 'text-right'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'options' => ['width'=>'240px']
            ],
            //'type',
            'description:ntext',
            //'rule_name',
            //'data:ntext',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d'],
                'options' => ['width'=>'200px']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d'],
                'options' => ['width'=>'200px']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
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
