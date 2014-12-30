<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingridients".
 *
 * @property integer $id
 * @property integer $unit_id
 * @property string $name
 *
 * @property Units $unit
 * @property Portions[] $portions
 */
class Ingridients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingridients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_id', 'name'], 'required'],
            [['unit_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'unit_id' => 'Идентификатор единицы измерения',
            'name' => 'Название ингридиета',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortions()
    {
        return $this->hasMany(Portions::className(), ['ingridient_id' => 'id']);
    }
}
