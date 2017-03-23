<?php

namespace common\components\mail\interfaces;

/**
 * Interface SendMailInterface
 * @package common\components\mail\interfaces\SendMailInterface
 */
interface SendMailInterface
{
    /**
     * Set from
     * @param $from
     * @return mixed
     */
    public function setFrom($from);

    /**
     * Set to
     * @param $to
     * @return mixed
     */
    public function setTo($to);

    /**
     * Set body
     * @param $message
     * @return mixed
     */
    public function setBody($message);

    /**
     * Set $template
     * @param $template
     * @param $params
     * @return mixed
     */
    public function setTemplate($template,$params);

    /**
     * Set subject
     * @param $subject
     * @return mixed
     */
    public function setSubject($subject);

    /**
     * Send email
     * @return mixed
     */
    public function send();

}