<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingestions".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 */
class Ingestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingestions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['position'], 'integer'],
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
            'name' => 'Название',
            'position' => 'Позиция',
        ];
    }
}
