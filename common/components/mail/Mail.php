<?php

namespace common\components\mail;

use Yii;
use common\components\mail\interfaces\SendMailInterface;

/**
 * Class Mail
 * @package common\components\mail
 */
class Mail
{
    /**
     * @var SendMailInterface
     */
    private $sendMail;

    /**
     * Mail constructor.
     * @param SendMailInterface $sendMail
     */
    public function __construct(SendMailInterface $sendMail)
    {
        $this->sendMail = $sendMail;
    }

    /**
     * Registration user
     * @param $params
     * @return array|\yii\web\Response
     */
    public function sendPlayerRegistration($params)
    {
        return $this->sendMail->setTemplate('@common/mail/template/sendPlayerRegistration.php',$params)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo($params['email'])
            ->setSubject('Pussy saga - Добро пожаловать в игру')
            ->send();
    }

    /**
     * Confirm email
     * @param $params
     * @return array|\yii\web\Response
     */
    public function sendPlayerConfirmEmail($params)
    {
        return $this->sendMail->setTemplate('@common/mail/template/sendPlayerConfirmEmail.php',$params)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo($params['email'])
            ->setSubject('Pussy saga - Подтверждение email')
            ->send();
    }
}
