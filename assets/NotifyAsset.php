<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
* Asset bundle for error handler with error.handler.js
*
* @author Miahil Kornilov <fix-06 at yandex.ru>
* @created 23.01.2015 22:40:21
*/
class NotifyAsset extends AssetBundle
{
    public $sourcePath = '@bower/notifyjs/dist';
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $js = [
        'notify.js',
        // 'styles/metro/notify-metro.js',
        'styles/bootstrap/notify-bootstrap.js',
    ];

    public $css = [
        // 'styles/metro/notify-metro.css',
    ];
}
