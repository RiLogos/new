<?php

namespace common\components\status;

/**
 * Interface StatusInterface
 * @package common\components\status
 */
interface StatusInterface
{
    /**
     * Set status code and data
     * @param int $code
     * @param mixed $data
     * @return mixed
     */
    public function set($code, $data = null);

    /**
     * Check status code
     * @param int $code
     * @return mixed
     */
    public function check($code);
}