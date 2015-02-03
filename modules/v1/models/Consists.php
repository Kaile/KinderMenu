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

    /**
     * Getting the ingridient related query via portion
     * @return \yii\db\ActiveQuery
     */
    public function getIngridient()
    {
        $this->getPortion()->getIngridient();
    }

    /**
     * Getting the unit related query via ingridient
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->getIngridient()->getUnit();
    }

    /**
     * Add fields that consist need
     * @return array fields and it values
     */
    public function fields()
    {
        $fields = parent::fields();

        $portion    = (object) $this->getPortion()->one();
        $ingridient = (object) $this->getIngridient()->one();
        $unit       = (object) $this->getUnit()->one();

        $fields['size'] = $portion->size;
        $fields['name'] = $ingridient->name;
        $fields['unit'] = $unit->name;

        return $fields;
    }
}
