<?php
namespace logs\models;

use Yii;

/**
 * Class Log
 * Logger model
 * @property integer $id
 * @property integer $level
 * @property string $category
 * @property double $log_time
 * @property string $prefix
 * @property string $message
 * @package app\modules\log\models
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritDoc}
     */
    public static function getDb()
    {
        return Yii::$app->db_admin;
    }
    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'category' => 'Category',
            'log_time' => 'Log Time',
            'prefix' => 'Prefix',
            'message' => 'Message',
        ];
    }
}
