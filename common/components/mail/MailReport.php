<?php

namespace common\components\mail;

use Yii;
use yii\helpers\Json;
use yii\mongodb\ActiveRecord;
use common\components\mail\interfaces\MailReportInterface;

/**
 * Class UserHistory
 * User history
 * @property \MongoId|string $_id
 * @property integer $user_id
 * @property integer $status
 * @property string $data
 * @property string $email
 * @property string $subject
 * @property integer $created_at
 *
 * @package common\components\mail\mongo
 */
class MailReport extends ActiveRecord implements MailReportInterface
{
    /**     
     * {@inheritDoc}
     */
    public static function collectionName()
    {
        return 'mail_report';
    }

    /**     
     * {@inheritDoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'user_id',
            'status',
            'subject',
            'email',
            'data',
            'created_at'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'email'], 'required'],
        ];
    }

    /**     
     * {@inheritDoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'subject' => 'Subject',
            'email' => 'Email',
            'data' => 'Data',
            'created_at' => 'Created At'
        ];
    }


    /**
     * before Save
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->created_at = Yii::$app->formatter->asDate(time(),'php:Y-m-d H:i:s');

            return true;
        }
        return false;
    }


    /**
     * Save user log
     * @param $data
     */
    public function saveLog($data)
    {
        $this->setAttributes([
            'status' => $data['response']['status'],
            'subject' => $data['subject'],
            'email' => $data['to'],
            'data' => Json::encode($data)
        ]);

        if(!$this->save())
            Yii::error(var_export($this->getErrors(), true), __METHOD__);
    }
}
