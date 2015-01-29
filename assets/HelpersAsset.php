<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
* Asset bundle for error handler with error.handler.js
*
* @author Miahil Kornilov <fix-06 at yandex.ru>
* @created 23.01.2015 22:40:21
*/
class HelpersAsset extends AssetBundle
{
    public $sourcePath = '@webroot/js/build/';
    public $depends = [
        'app\assets\NotifyAsset',
    ];
    public $js = [
        'helpers.js',
    ];
}
