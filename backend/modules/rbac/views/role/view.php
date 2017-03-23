<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model rbac\models\AuthItem */
/* @var $searchPermission rbac\models\AuthItemSearch */
/* @var $dataPermission yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'name' => $model->name], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data:ntext',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <h2>Permissions</h2>

    <?php
        echo $this->render('_permission', [
            'searchPermission' => $searchPermission,
            'dataPermission' =>$dataPermission,
            'model' =>$model
        ]);
    ?>

</div>
