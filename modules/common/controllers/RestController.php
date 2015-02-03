<?php

namespace app\modules\common\controllers;

/**
 * @created 31.01.2015 14:54:23
 * @author Mihail Kornilov <fix-06 at yandex.ru>
 *
 * @since 1.0
 */
class RestController extends \yii\rest\ActiveController
{
    /**
     * Add new actions to standart, declared in ActiveController
     * @return array actions
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['relation'] = [
            'class' => 'app\modules\common\controllers\actions\RelationAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
        ];

        $actions['index'] = [
            'class' =>'app\modules\common\controllers\actions\IndexAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
        ];

        return $actions;
    }
}
