<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Таблица будет содержать блюда, относящиеся к определенному приему пищи
 */
class m150107_150518_TableIngestionDish extends Migration
{
	const TABLE_NAME = 'ingestion_dish';

	const TABLE_DISH = 'dishes';
	const TABLE_INGESTION = 'ingestions';

	const FK_DISH = 'fk_dish';
	const FK_INGESTION = 'fk_ingestion';

	const COLUMN_DISH = 'dish_id';
	const COLUMN_INGESTION = 'ingestion_id';

	public function up()
	{
		$this->createTable(self::TABLE_NAME, [
			'id' => 'pk comment "Идентификатор"',
			'ingestion_id' => 'int not null comment "Идентификатор приема пищи"',
			'dish_id' => 'int not null comment "Идентификатор блюда"',
			'name' => 'string null comment "Название"',

		]);

		$this->addForeignKey(self::FK_DISH, self::TABLE_NAME, self::COLUMN_DISH, self::TABLE_DISH, 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey(self::FK_INGESTION, self::TABLE_NAME, self::COLUMN_INGESTION, self::TABLE_INGESTION, 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		return $this->dropTable(self::TABLE_NAME);
	}
}
