<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consists".
 *
 * @property integer $id
 * @property integer $portion_id
 * @property integer $dish_id
 *
 * @property Portions $portion
 * @property Dishes $dish
 */
class Consists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['portion_id', 'dish_id'], 'required'],
            [['portion_id', 'dish_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'portion_id' => 'Идентификатор порции',
            'dish_id' => 'Идентификатор блюда',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortion()
    {
        return $this->hasOne(Portions::className(), ['id' => 'portion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'dish_id']);
    }
}
