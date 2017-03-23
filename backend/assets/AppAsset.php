<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    /** @var string base path */
    public $basePath = '@webroot';
    /** @var string base url */
    public $baseUrl = '@web';
    /** @var array css file */
    public $css = [
        'css/site.css',
    ];
    /** @var array js file */
    public $js = [
    ];
    /** @var array Depends */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
