<?php

namespace rbac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class AuthAssignment
 * Assignment model role
 * @property string $item_name
 * @property string $user_id
 * @property integer $created_at
 *
 * @property AuthItem $itemName
 * @package app\modules\rbac\models
 */
class AuthAssignment extends ActiveRecord
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
        return 'auth_assignment';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at','user_id'], 'integer'],
            [['item_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }
    
    /**
     * List behaviors
     * @return array
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

    /**
     * Get assignment
     * @param $id
     * @return array
     */
    public static function getAssignment($id)
    {
        return ArrayHelper::getColumn(AuthAssignment::findAll(['user_id' => $id]), 'item_name');
    }
}
