<?php

namespace app\themes\prepro\assets;

use yii\web\AssetBundle;

/**
 * Class PreProAsset
 * @package app\themes\prepro\assets
 */
class PreProAsset extends AssetBundle
{
	/**
     * {@inheritDoc}
     */
    public $sourcePath = '@app/themes/prepro/';

    /**
     * {@inheritDoc}
     */
    public $css = [
        'public/css/prepro.css'
    ];

    /**
     * {@inheritDoc}
     */
    public $js = [
        'public/js/prepro.js'
    ];

    /**
     * {@inheritDoc}
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    /**
     * {@inheritDoc}
     */
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
