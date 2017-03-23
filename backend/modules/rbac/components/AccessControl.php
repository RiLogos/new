<?php
namespace rbac\components;

use Yii;
use yii\web\User;
use yii\di\Instance;
use yii\base\Module;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

/**
 * Class AccessControl
 * Access Control Admin
 * @property User $user
 * @package backend\modules\rbac\components
 */
class AccessControl extends ActionFilter
{
    /**
     * @var User User for check access.
     */
    private $_user = 'user';
    /**
     * @var array List of action that not need to check access.
     */
    public $allowActions = [];
    /**
     * Get user
     * @return User
     */
    public function getUser()
    {
        if (!$this->_user instanceof User) {
            $this->_user = Instance::ensure($this->_user, User::className());
        }
        return $this->_user;
    }
    /**
     * Set user
     * @param User|string $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }
    /**
     * {@inheritDoc}
     */
    public function beforeAction($action)
    {
        $actionId = $action->getUniqueId();
        $user = $this->getUser();

        if ($user->can('/' . $actionId)) {
            return true;
        }

        if($user->isGuest)
            $this->denyAccess($user);

        $obj = $action->controller;
        do {
            if($user->can($action->id . ucfirst($obj->id)))
                return true;

            $obj = $obj->module;
        } while ($obj !== null);

        $this->denyAccess($user);

        return false;
    }

    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, a 403 HTTP exception will be thrown.
     * @param  User $user the current user
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
    /**
     * {@inheritDoc}
     */
    protected function isActive($action)
    {
        $uniqueId = $action->getUniqueId();
        if ($uniqueId === Yii::$app->getErrorHandler()->errorAction) {
            return false;
        }
        $user = $this->getUser();
        if ($user->getIsGuest() && is_array($user->loginUrl) && isset($user->loginUrl[0]) && $uniqueId === trim($user->loginUrl[0], '/')) {
            return false;
        }
        if ($this->owner instanceof Module) {
            // convert action uniqueId into an ID relative to the module
            $mid = $this->owner->getUniqueId();
            $id = $uniqueId;
            if ($mid !== '' && strpos($id, $mid . '/') === 0) {
                $id = substr($id, strlen($mid) + 1);
            }
        } else {
            $id = $action->id;
        }
        foreach ($this->allowActions as $route) {
            if (substr($route, -1) === '*') {
                $route = rtrim($route, '*');
                if ($route === '' || strpos($id, $route) === 0) {
                    return false;
                }
            } else {
                if ($id === $route) {
                    return false;
                }
            }
        }
        if ($action->controller->hasMethod('allowAction') && in_array($action->id, $action->controller->allowAction())) {
            return false;
        }
        return true;
    }
}