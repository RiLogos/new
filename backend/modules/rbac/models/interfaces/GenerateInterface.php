<?php

namespace rbac\models\interfaces;

/**
 * Interface GenerateInterface
 * @package rbac\models\interfaces
 */
interface GenerateInterface
{
    /**
     * Import role to db
     * @return mixed
     */
    public function import();
}