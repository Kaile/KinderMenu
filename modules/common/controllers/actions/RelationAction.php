<?php

namespace app\modules\common\controllers\actions;

/**
 * @created 31.01.2015 14:32:22
 * @author Mihail Kornilov <fix-06 at yandex.ru>
 *
 * @since 1.0
 */
class RelationAction extends \yii\rest\Action
{
    /**
     * Get all records that has been included in model class of current controller
     * @param  int $id          identifier of searched items
     * @param  string $relation name of model that identifier was found in
     * @return ActiveRecordInterface  founded models
     */
    public function run($id, $relation)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::findAll([strtolower(rtrim($relation, 's')) . '_id' => $id]);

        return $model;
    }
}
