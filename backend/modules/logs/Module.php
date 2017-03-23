<?php

namespace logs;

/**
 * Class Log module
 * @package app\modules\log
 */
class Module extends \yii\base\Module
{
	/** @var string $controllerNamespace controller namespace */
    public $controllerNamespace = 'logs\controllers';

    /** @var string $defaultRoute default route */
    public $defaultRoute = 'log/index';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();
    }
}
