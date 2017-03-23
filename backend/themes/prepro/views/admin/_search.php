<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\admin\Admin;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => Admin::statusAll(),
        'options' => [
            'placeholder' => 'Select status...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
