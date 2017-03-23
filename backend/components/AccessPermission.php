<?php
namespace backend\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class AccessPermission
 * Permission user
 * @package backend\components
 */
class AccessPermission extends Component
{
	/**
     * @var $permission array permission
     */
    public static $permission;

    /**
     * Initialization of the available menu accesses
     */
    public static function access()
    {
        if (!Yii::$app->user->isGuest && empty(self::$permission)) {
            self::$permission = ArrayHelper::getColumn(Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id),'name');
        }
    }

    /**
     * Display menu item
     * @param $item
     * @return bool
     */
    public static function can($item)
    {
        if(!Yii::$app->user->isGuest && !empty(self::$permission) && array_search($item,self::$permission) != false)
            return true;
        return false;
    }

    /**
     * Show general category
     * @param $array
     * @return bool
     */
    public static function canGeneral($array)
    {
        if(!Yii::$app->user->isGuest )
            foreach ($array as $item)
                if(array_search($item,self::$permission) != false)
                    return true;

        return false;
    }
}