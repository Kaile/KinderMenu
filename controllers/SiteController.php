<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMenu()
    {
        return $this->render('menu');
    }
}
