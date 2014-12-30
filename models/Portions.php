<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portions".
 *
 * @property integer $id
 * @property integer $ingridient_id
 * @property integer $size
 *
 * @property Consists[] $consists
 * @property Ingridients $ingridient
 */
class Portions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingridient_id', 'size'], 'required'],
            [['ingridient_id', 'size'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'ingridient_id' => 'Идентификатор ингридиента',
            'size' => 'Количество',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsists()
    {
        return $this->hasMany(Consists::className(), ['portion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngridient()
    {
        return $this->hasOne(Ingridients::className(), ['id' => 'ingridient_id']);
    }
}
