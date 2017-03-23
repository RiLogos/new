<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */

class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}
/**
 * @property common\components\mail\Mail $mail
 * @property common\components\status\Status $status
 * @property yii\caching\FileCache $cache
 **/
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * @property yii\rbac\DbManager $authManager
 * @property yii\web\UrlManager $urlManager
 * @property yii\db\Connection $db_admin
 * @property yii\db\Connection $db
 * @property yii\web\Request $request
 * @property yii\web\Response $response
 **/
class WebApplication extends yii\web\Application
{
}

/**
 * @property common\components\encrypt\interfaces\EncryptInterface $encrypt
 **/
class ConsoleApplication extends yii\console\Application
{
}
