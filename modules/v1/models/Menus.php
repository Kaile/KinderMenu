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
			[['name'], 'string', 'max' => 255],
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
			'name' => 'Название меню',
			'date' => 'Дата создания меню',
		];
	}

	public function beforeSave($inserted)
	{
		$this->date = date('Y/m/d');

		return true;
	}
}
