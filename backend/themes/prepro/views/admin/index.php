<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\admin\Admin;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\admin\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->username, Url::to(['admin/view', 'id' => $data->id]));
                },
            ],
            [
                'attribute' => 'role',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->role;
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'options' => ['width' => '130px'],
                'value' => function ($data) {
                    return Html::DropDownList('title', $data->status,
                        Admin::statusAll(),
                        [
                            'class' => 'form-control',
                            'onchange' => '$.post( "' . Url::toRoute('/admin/status') . '", { id: $(this).val(), user:' . $data->id . '} )',
                        ]
                    );
                },
                'visible' => Yii::$app->user->can('statusAdmin'),
                'filter' => false,
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
