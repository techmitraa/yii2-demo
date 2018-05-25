<?php
namespace common\assets;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{
    public $basePath = '@commonBase';
    public $baseUrl = '@commonWeb';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:400,500',
        'css/global-common.css',
        'plugins/bootstrap/css/bootstrap.min.css'
    ];
    public $js = [
        'plugins/jquery-ui/js/jquery-ui.min.js',
        'plugins/popper.js/js/popper.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/jquery-slimscroll/js/jquery.slimscroll.js',
        'plugins/modernizr/js/modernizr.js',
        'plugins/modernizr/js/css-scrollbars.js',
        'js/global-common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}