<?php

namespace common\components\mail\interfaces;

/**
 * Interface MailReportInterface
 * @package common\components\mail\interfaces\MailReportInterface
 */
interface MailReportInterface
{
    /**
     * Save user log
     * @param $data
     */
    public function saveLog($data);
}