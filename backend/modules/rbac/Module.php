<?php

//namespace app\modules\rbac;
namespace rbac;

use yii\base\BootstrapInterface;

/**
 * Module for control admin's permissions's and roles
 * @package app\modules\rbac
 */
class Module extends \yii\base\Module  implements BootstrapInterface
{
    /** @var string  $controllerNamespace controller namespace*/
    public $controllerNamespace = 'rbac\controllers';
    /** @var string $defaultRoute default route*/
    public $defaultRoute = 'role';
    /** @var object class user */
    public $userClass = 'app\models\User';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();
    }

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {

            $this->controllerNamespace = 'rbac\commands';

        }
    }
}
