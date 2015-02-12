<?php

namespace app\modules\v1\models;

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
    public $size = 0;
    public $unit = 0;
    public $name = '';
    public $shortName = '';

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
     * Getting the portion related query
     * @return \yii\db\ActiveQuery
     */
    public function getPortion()
    {
        return $this->hasOne(Portions::className(), ['id' => 'portion_id']);
    }

    /**
     * Getting the dish related query
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'dish_id']);
    }
}
