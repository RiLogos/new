<?php

namespace rbac\models;

use Yii;
use yii\rbac;
use yii\db\Exception;
use yii\rbac\PhpManager;

/**
 * Class Generate
 * Generate rbac
 * @package app\modules\rbac\models
 */
class Generate
{
    /** @var string $itemFile item file*/
    public $itemFile = '@app/modules/rbac/data/items.php';
    /** @var string $managerFile manager file*/
    private $managerFile;
    /** @var array $error errors*/
    private $error = [];

    /**
     * Show users and theirs roles
     * @return string
     */
    public function import()
    {
        /** @var PhpManager managerFile */
        $this->managerFile = Yii::createObject([
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => $this->itemFile,
        ]);
        //delete data
        AuthItem::deleteAll();
        //export permissions
        $this->importPermission($this->managerFile->getPermissions());
        //export roles
        $this->importRoles($this->managerFile->getRoles());
    }

    /**
     * Import roles from file to DB
     * @param $items
     * @throws Exception
     */
    private function importRoles($items)
    {
        foreach ($items as $name => $item) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $item_m = new AuthItem();
                $item_m->name = $name;
                $item_m->description = $item->description;
                $item_m->type = AuthItem::TYPE_ROLE;

                if ($item_m->save()) {
                    //save relations between role and permission
                    foreach ($this->managerFile->getChildren($name) as $value) {
                        $child = new AuthItemChild();
                        $child->parent = $item_m->name;
                        $child->child = $value->name;
                        if (!$child->save())
                            $this->error[] = $child->getErrors();
                    }
                } else
                    $this->error[] = $item_m->getErrors();

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }

    /**
     * Import permission from file to DB
     * @param $items
     * @throws Exception
     */
    private function importPermission($items)
    {
        foreach ($items as $name => $item) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $item_m = new AuthItem();
                $item_m->name = $name;
                $item_m->description = $item->description;
                $item_m->type = AuthItem::TYPE_PERMISSION;

                if (!$item_m->save())
                    $this->error[] = $item_m->getErrors();

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }
}