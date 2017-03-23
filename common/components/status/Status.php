<?php

namespace common\components\status;

/**
 * Class Status
 * @package api\components\status
 */
class Status implements StatusInterface
{
    /** @var int status code */
    public $code = 102;

    /** @var string status text */
    public $text;

    /** @var array status data */
    public $data;

    /**
     * Set code, text, data
     * @param int $code
     * @param null $text
     * @param null $data
     * @return $this
     */
    public function set($code, $text = null, $data = null)
    {
        $this->setCode($code);
        $this->text = $text;
        $this->data = $data;

        return $this;
    }

    /**
     * Set code and text
     * @param int $code
     * @param string $text
     * @return $this
     */
    public function setText($code, $text)
    {
        $this->setCode($code);
        $this->text = $text;

        return $this;
    }

    /**
     * Set code and data
     * @param int $code
     * @param array $data
     * @return $this
     */
    public function setData($code, $data)
    {
        $this->setCode($code);
        $this->data = $data;

        return $this;
    }

    /**
     * Set code
     * @param $code
     */
    public function setCode($code){
        $this->code = $code;
    }

    /**
     * Check status code
     * @param int $code - code to check int or array
     * @return bool
     */
    public function check($code)
    {
        return ((is_array($code) && in_array($this->code, $code)) || (!is_array($code) && $code == $this->code));
    }


    private function defaultStatusText($code){
        $defaultStatusText = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'Ok',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            410 => 'Gone',
            415 => 'Unsupported Media',
            423 => 'Locked',
            426 => 'Upgrade Required',
            500 => 'Internal Server Error',
            503 => 'Service Unavailable',
            505 => 'HTTP Version Not Supported',
            511 => 'Network Authentication Required'
        ];

        return isset($defaultStatusText[$code]) ? $defaultStatusText[$code]: '';
    }
}
