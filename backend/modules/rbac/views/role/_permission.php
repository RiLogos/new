<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model rbac\models\AuthItem */
/* @var $searchPermission rbac\models\AuthItemSearch */
/* @var $dataPermission yii\data\ActiveDataProvider */
?>

<?= GridView::widget([
    'dataProvider' => $dataPermission,
    'filterModel' => $searchPermission,
    'summaryOptions' => ['class' => 'text-right'],
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'options' => ['width'=>'20px'],
            'checkboxOptions' => function ($p_model)use($model){
                return [
                    'value' => $p_model->name,
                    'onchange' => '$.post("'.Url::toRoute(['permission/change-permission']).'",  {"permission":"'.$p_model->name.'","role":"'.$model->name.'"} )',
                    'class'=>'form-control',
                    'style' => 'width:20px;height:20px',
                    'checked' => ArrayHelper::getValue($model->authItemChildren,
                        function ($item) use ($model,$p_model){
                            foreach ($item as $value) {
                                if($value->parent == $model->name && $value->child == $p_model->name)
                                    return 'checked';
                            }
                            return false;
                        })
                ];
            },
            'header' => '',
        ],
        [
            'attribute' => 'name',
            'options' => ['width'=>'240px']
        ],
        'description:ntext',
        'rule_name',
    ],
]); ?>
