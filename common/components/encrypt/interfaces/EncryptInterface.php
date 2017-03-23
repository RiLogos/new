<?php

namespace common\components\encrypt\interfaces;

/**
 * Interface EncryptInterface
 * @package common\components\encrypt\interfaces
 */
interface EncryptInterface
{
    /**
     * Initialization encrypt
     * @return mixed
     */
    public function init();

    /**
     * Encrypt data
     * @param $payload
     * @return mixed
     */
    public function encrypt($payload);

    /**
     * Decrypt data
     * @param $payload
     * @return mixed
     */
    public function decrypt($payload);

}