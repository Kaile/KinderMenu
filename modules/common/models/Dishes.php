<?php

namespace app\modules\common\models;

use Yii;

/**
 * This is the model class for table "dishes".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Consists[] $consists
 */
class Dishes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
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
            'name' => 'Название блюда',
            'description' => 'Описание блюда',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsists()
    {
        return $this->hasMany(Consists::className(), ['dish_id' => 'id']);
    }
}
