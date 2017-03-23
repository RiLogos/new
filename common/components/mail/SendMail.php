<?php

namespace common\components\mail;

use Yii;
use yii\base\Component;
use yii\base\ErrorException;
use yii\web\Response;
use yii\validators\EmailValidator;
use common\components\mail\interfaces\SendMailInterface;
use common\components\mail\interfaces\MailReportInterface;

/**
 * Class SendMail
 * @package common\components\mail
 */
class SendMail extends Component implements SendMailInterface
{
    /** @var string адрес отправителя */
    private $from;
    /** @var string адрес получателя */
    private $to;
    /** @var string тема письма */
    private $subject;
    /** @var string сообщение */
    private $message;
    /** @var string params */
    private $params;
    /** @var string template */
    private $template;
    /** @var MailReportInterface $report */
    private $report;


    /**
     * SendMail constructor.
     * @param MailReportInterface $report
     */
    public function __construct(MailReportInterface $report)
    {
        $this->report = $report;

        parent::__construct();
    }

    /**
     * Валидация email
     * @param $email
     * @return bool
     */
    private function validateEmail($email)
    {
        $validator = new EmailValidator();

        if ($validator->validate($email))
           return true;

        return false;
    }

    /**
     * Установка адреса отправителя
     * @param string $from Адреса отправителя
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Установка адреса получателя
     * @param string $to Адреса получателя
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Установка текста сообщения.
     * @param null $message Текст сообщения
     * @return $this
     */
    public function setBody($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Установка текста сообщения.
     * @param string $template Текст сообщения
     * @param array $params Параметры
     * @return $this
     */
    public function setTemplate($template,$params = [])
    {
        $this->params = $params;

        $this->template = $template;

        return $this;
    }


    /**
     * Установка темы сообщения.
     * @param null $subject Тема сообщения
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Property to array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        foreach ($this as $name => $value)
            $data[$name] = $value;

        return $data;
    }

    /**
     * Статус выполнения
     * @param $code
     * @param $text
     * @return array|Response
     */
    public function Response($code, $text)
    {
        $this->report->saveLog($this->toArray()); //save log

        return Yii::$app->status->set($code, $text);
    }

    /**
     * @return array|Response
     */
    public function send()
    {
        try{
            if (empty($this->from))
                return Yii::$app->status->set(400, 'Не указан адрес отправителя');

            if(!$this->validateEmail($this->from))
                return Yii::$app->status->set(400, 'Не валидный email отправителя');

            if (empty($this->to))
                return Yii::$app->status->set(400, 'Не указан адрес получателя');

            if(!$this->validateEmail($this->to))
                return Yii::$app->status->set(400, 'Не валидный email получателя');

            if (empty($this->subject))
                return Yii::$app->status->set(400, 'Не указана тема сообщения');

            if(!empty($this->message) || !empty($this->template)){

                if(!empty($this->template))
                    $this->message = Yii::$app->controller->renderPartial($this->template, $this->params);

                $sendResult = Yii::$app->mailer->compose()->setHtmlBody($this->message);

                $sendResult->setFrom($this->from)
                    ->setTo($this->to)
                    ->setSubject($this->subject)
                    ->send();

                if($sendResult)
                    return Yii::$app->status->set(200, 'Отправка выполнена');
                else{
                    Yii::error('Письмо не отправлено: ' . var_export($this, TRUE), __METHOD__);
                    return Yii::$app->status->set(400, 'Отправка не выполнена');
                }
            }else{
                return Yii::$app->status->set(400, 'Не указан текст сообщения');
            }
        }catch (ErrorException $e){
            Yii::error('Ошибка отправки: ' . $e->getMessage(), __METHOD__);
            return Yii::$app->status->set(400, 'Ошибка выполнения');
        }
    }
}











