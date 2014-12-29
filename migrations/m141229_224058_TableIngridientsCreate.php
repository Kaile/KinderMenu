<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Создание таблицы ингридиентов, которые входят в состав различных блюд.
 * Различные ингридиеты измеряются в единицах измерения, в зависимости от
 * меры, которая определяет способ измерения ингридиета.
 */
class m141229_224058_TableIngridientsCreate extends Migration
{
    const TABLE_NAME = 'ingridients';
    const FK_NAME = 'fk_ingridients_units';
    const FK_TABLE_NAME = 'units';
    const FK_COLUMN = 'unit_id';

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
                'id' => 'pk comment "Идентификатор"',
                self::FK_COLUMN => 'int not null comment "Идентификатор единицы измерения"',
                'name' => 'string not null comment "Название ингридиета"',
            ]);

        $this->addForeignKey(self::FK_NAME, self::TABLE_NAME, self::FK_COLUMN, self::FK_TABLE_NAME, 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_NAME, self::TABLE_NAME);
        return $this->dropTable(self::TABLE_NAME);
    }
}
