<?php

namespace app\modules\common\routes;

class BaseUrlRule extends \yii\rest\UrlRule
{
    public $extraPatterns = [
        'GET,HEAD {id}/<relation:\\w*>' => 'relation',
    ];

    public $suffix = '/';
}
