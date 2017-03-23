<?php

namespace rbac\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class AuthRule
 * Rules rbac
 * @property string $name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthItem[] $authItems
 * @package app\modules\rbac\models
 */
class AuthRule extends ActiveRecord
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
        return 'auth_rule';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }
}
