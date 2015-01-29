<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "menus".
 *
 * @property integer $id
 * @property integer $dish_id
 * @property integer $ingestion_id
 * @property string $date
 *
 * @property Ingestions $ingestion
 * @property Dishes $dish
 */
class Menus extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'menus';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['dish_id', 'ingestion_id', 'date'], 'required'],
			[['dish_id', 'ingestion_id'], 'integer'],
			[['date'], 'safe']
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
			'date' => 'Дата создания меню',
		];
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
	public function getDish()
	{
		return $this->hasOne(Dishes::className(), ['id' => 'dish_id']);
	}

	public function beforeSave($inserted)
	{
		$this->date = date('Y/m/d');

		return true;
	}

	public function fields()
	{
		$fields = parent::fields();

		return $fields;
	}
}
