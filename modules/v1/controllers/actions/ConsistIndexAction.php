<?php

namespace app\modules\v1\controllers\actions;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class ConsistIndexAction extends \yii\rest\Action
{
    public function run()
    {
        $queryParams = Yii::$app->request->queryParams;
        $modelClass = $this->modelClass;
        $query = new Query();
        $query->select([
                    'id'        => 'consists.id',
                    'dish_id'   => 'consists.dish_id',
                    'name'      => 'ingridients.name',
                    'size'      => 'portions.size',
                    'shortName' => 'units.symbol',
                    'unit'      => 'units.name',
                ])
                ->from('consists')
                ->leftJoin('portions', 'portions.id = consists.portion_id')
                ->leftJoin('ingridients', 'ingridients.id = portions.ingridient_id')
                ->leftJoin('units', 'units.id = ingridients.unit_id');

        if (is_array($queryParams)) {
            $query->where($queryParams);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
