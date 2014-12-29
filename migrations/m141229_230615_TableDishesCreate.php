<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Создание таблицы блюд.
 * Блюдо состоит из ингридиентов.
 */
class m141229_230615_TableDishesCreate extends Migration
{
    const TABLE_NAME = 'dishes';
    const FK_NAME = 'fk_dishes_consists';
    const FK_TABLE_NAME = 'consists';
    const FK_COLUMN = 'consist_id';

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
                'id' => 'pk comment "Идентификатор"',
                self::FK_COLUMN => 'int not null comment "Идентификатор состава"',
                'name' => 'string not null comment "Название блюда"',
                'description' => 'text null comment "Описание блюда"',
            ]);

            $this->addForeignKey(self::FK_NAME, self::TABLE_NAME, self::FK_COLUMN, self::FK_TABLE_NAME, 'id', 'CASCADE', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey(self::FK_NAME, self::TABLE_NAME);
            return $this->dropTable(self::TABLE_NAME);
        }
}
