<?php

namespace app\modules\common\controllers\actions;

use Yii;
use yii\data\ActiveDataProvider;

class IndexAction extends \yii\rest\IndexAction
{
    public function run()
    {
        $queryParams = Yii::$app->request->queryParams;
        $modelClass = $this->modelClass;
        $query = null;

        if (is_array($queryParams)) {
            $query = $modelClass::find()->where($queryParams);
        } else {
            $query = $modelClass::find();
        }
        
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }


}
