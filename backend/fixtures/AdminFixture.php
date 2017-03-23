<?php
namespace backend\fixtures;

use yii\test\ActiveFixture;

class AdminFixture extends ActiveFixture
{
    public $modelClass = 'backend\models\admin\Admin';
    public $db = 'db_admin';
}