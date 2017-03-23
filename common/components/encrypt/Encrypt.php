<?php

namespace common\components\encrypt;

use yii\base\Component;
use yii\base\InvalidConfigException;
use common\components\encrypt\interfaces\EncryptInterface;

/**
 * Class Encrypt
 * @package common\components
 */
class Encrypt extends Component implements EncryptInterface
{
    /** @var string contain current secret key */
    public $secret_key;
    /** @var string contain current encrypt method */
    public $encrypt_method = "AES-256-CBC";
    /** @var int iterations */
    public $iterations = 1;
    /** @var int salt size */
    public $salt_site = 3;

    /** @var int current iv length */
    private $ivLength;
    /** @var string current iv key part */
    private $ivKeyPart;
    /** @var string current password key part */
    private $passwordKeyPart;

    /**
     * Init method
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->secret_key))
            throw new InvalidConfigException('Do encrypt:init or set param "secret_key" in config if already init.');

        $this->ivLength = openssl_cipher_iv_length($this->encrypt_method);//16
        $hash = hash_pbkdf2("sha256", md5($this->secret_key), $this->secret_key, $this->iterations, $this->ivLength * 2);

        $this->passwordKeyPart = substr($hash, 0, $this->ivLength);
        $this->ivKeyPart = substr($hash, $this->ivLength);
    }

    /**
     * Core encrypt method.
     * @param $payload - encrypt target string
     * @return string
     */
    public function encrypt($payload)
    {
        $payload = base64_encode(openssl_random_pseudo_bytes($this->salt_site) . $payload);

        $payload = openssl_encrypt($payload, $this->encrypt_method, $this->passwordKeyPart, false, $this->ivKeyPart);

        return $payload;
    }

    /**
     * Core decrypt method.
     * @param $payload - decrypt target string
     * @return string
     */
    public function decrypt($payload)
    {
        $payload = openssl_decrypt($payload, $this->encrypt_method, $this->passwordKeyPart, false, $this->ivKeyPart);

        $payload = substr(base64_decode($payload), $this->salt_site);

        return $payload;
    }

}