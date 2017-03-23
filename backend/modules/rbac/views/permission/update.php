<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rbac\models\AuthItem */

$this->title = 'Edit permission';
$this->params['breadcrumbs'][] = ['label' => 'Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form',[
        'model' => $model
    ]) ?>

</div>
