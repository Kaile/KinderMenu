<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "units".
 *
 * @property integer $id
 * @property integer $measure_id
 * @property string $name
 * @property integer $ratio
 * @property string $symbol
 *
 * @property Ingridients[] $ingridients
 * @property Measures $measure
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'units';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['measure_id', 'name', 'ratio', 'symbol'], 'required'],
            [['measure_id', 'ratio'], 'integer'],
            [['name', 'symbol'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'measure_id' => 'Идентификатор меры',
            'name' => 'Название единицы измерения',
            'ratio' => 'Отношение',
            'symbol' => 'Обозначение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngridients()
    {
        return $this->hasMany(Ingridients::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasure()
    {
        return $this->hasOne(Measures::className(), ['id' => 'measure_id']);
    }
}
