<?php

namespace common\components\dependency;

use yii\base\Behavior;

/**
 * Class Dependency
 * @package common\components\dependency
 */
class Dependency extends Behavior
{
    /** @var array dependency */
    public $dependency = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        foreach ($this->dependency as $parent => $child)
            \Yii::$container->set($parent, $child);

        return true;
    }
}