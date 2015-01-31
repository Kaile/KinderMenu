<?php

namespace app\modules\v1\controllers;

use Yii;

class DemoController extends \yii\rest\Controller
{
    public function actionIndex()
    {

        return Yii::$app->request->queryParams;
    }

    public function actionView()
    {
        return ['action' => 'view'];
    }

    public function actionCreate(array $params)
    {
        return Yii::$app->request->bodyParams;
    }

    public function actionRelation($id, $relation)
    {
        return [$id => $relation];
    }
}
