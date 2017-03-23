<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\log\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logging';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
//            [
//                'attribute' => 'log_time',
//                'format' => ['date', 'php:Y-m-d H:i:s'],
//                'options' => ['width'=>'150px'],
//            ],
            [
                'attribute' => 'level',
                'options' => ['width'=>'30px']
            ],
            [
                'attribute' => 'category',
                'format' => 'raw',
                'options' => ['width'=>'200px'],
                'value' => function ($data) {
                    return Html::a($data->category , Url::to(['view', 'id' => $data->id]));
                },
            ],
            'message:ntext',
        ],
    ]); ?>

</div>
