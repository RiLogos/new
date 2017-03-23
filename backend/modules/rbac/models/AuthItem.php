<?php

namespace rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class AuthItem
 * Role and permissions model
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 *
 * @see AuthItem::SCENARIO_ROLE
 * @see AuthItem::SCENARIO_DEFAULT
 * @see AuthItem::SCENARIO_PERMISSION
 *
 * @see AuthItem::TYPE_ROLE
 * @see AuthItem::TYPE_PERMISSION
 */
class AuthItem extends ActiveRecord
{
    const SCENARIO_ROLE = 'role';
    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_PERMISSION = 'permission';

    const TYPE_ROLE = 1;
    const TYPE_PERMISSION = 2;

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
        return 'auth_item';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'on' => [self::SCENARIO_ROLE,self::SCENARIO_PERMISSION]],
            [['name', 'type'], 'required','on' => self::SCENARIO_DEFAULT],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],

        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rules',
            'data' => 'Data',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }
}
