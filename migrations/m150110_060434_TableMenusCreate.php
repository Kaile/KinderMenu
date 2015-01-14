<?php

use yii\db\Schema;
use yii\db\Migration;

class m150110_060434_TableMenusCreate extends Migration
{
	const TABLE_NAME = 'menus';

	const DELETE_TABLE = 'ingestion_dish';

	public function up()
	{
		$this->dropTable(self::DELETE_TABLE);

		$this->createTable(self::TABLE_NAME, [
			'id' => 'pk comment "Идентификатор меню"',
			'name' => 'string comment "Название меню"',
			'date' => 'date not null comment "Дата меню"',
		]);
	}

	public function down()
	{
		$this->createTable(self::DELETE_TABLE, [
			'id' => 'pk',
			'dish_id' => 'int',
			'ingestion_id' => 'int',
		]);

		return $this->dropTable(self::TABLE_NAME);
	}
}
