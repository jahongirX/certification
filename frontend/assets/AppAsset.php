<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{    
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/bootstrap.min.css",
        "css/icons.min.css",
        "css/app.min.css",
        'libs/c3/c3.min.css',
        'fonts/stylesheet.css',
        'css/custom.css'
    ];

    public $js = [
//        "js/vendor.min.js",
        "libs/morris-js/morris.min.js",
        "libs/raphael/raphael.min.js",
        "js/pages/dashboard-4.init.js",
        "libs/d3/d3.min.js",
        "libs/c3/c3.min.js",
        "js/app.min.js",
        'js/custom.js'
    ];

    public $jsOptions = [

    ];

    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

     public $depends = [
         'yii\web\YiiAsset',
     ];


}
