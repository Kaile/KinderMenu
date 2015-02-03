<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\db\Query;
use app\modules\v1\models\Dishes;
use yii\data\ActiveDataProvider;

class MenuDishesController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        $queryParams = Yii::$app->request->queryParams;

        if (array_key_exists('ingestion_id', $queryParams) && array_key_exists('menu_id', $queryParams)) {
            return (new Query())
                    ->select('dishes.*')
                    ->from('dishes')
                    ->leftJoin('menu_consists', 'menu_consists.dish_id = dishes.id')
                    ->where([
                        'menu_consists.ingestion_id' => $queryParams['ingestion_id'],
                        'menu_consists.menu_id' => $queryParams['menu_id'],
                    ])
                    ->all();
        }

        return new ActiveDataProvider([
            'query' => Dishes::find(),
        ]);
    }
}
