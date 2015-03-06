<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "menu_consists".
 *
 * @property integer $id
 * @property integer $dish_id
 * @property integer $ingestion_id
 * @property integer $menu_id
 *
 * @property Dishes $dish
 * @property Ingestions $ingestion
 * @property Menus $menu
 */
class MenuConsists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_consists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'ingestion_id', 'menu_id'], 'required'],
            [['dish_id', 'ingestion_id', 'menu_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'dish_id' => 'Идентификатор блюда',
            'ingestion_id' => 'Идентификатор приема пищи',
            'menu_id' => 'Идентификатор меню',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngestion()
    {
        return $this->hasOne(Ingestions::className(), ['id' => 'ingestion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::className(), ['id' => 'menu_id']);
    }
}
