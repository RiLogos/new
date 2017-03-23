<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rbac\models\AuthItem */
/* @var $form ActiveForm */
?>
<div class="form-index">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord){?>
        <?= $form->field($model, 'name')->textInput() ?>
    <?php } ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>