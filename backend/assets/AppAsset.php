<?php
namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/waves.min.css',
        'icon/themify-icons/themify-icons.css',
        'icon/icofont/css/icofont.css',
        'icon/font-awesome/css/font-awesome.min.css',
        'css/style.css'
    ];
    public $js = [
        'js/waves.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
