<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Создание таблицы состава блюда меню.
 * Состав блюда содержит ингридиеты, из которых это блюдо приготовлено.
 * Также в составе указывается количественная мера ингридиета.
 */
class m141229_225811_TableConsistsCreate extends Migration
{
    const TABLE_NAME = 'consists';
    const FK_NAME = 'fk_consists_ingridients';
    const FK_TABLE_NAME = 'ingridients';
    const FK_COLUMN = 'ingridient_id';

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
                'id' => 'pk comment "Идентификатор"',
                self::FK_COLUMN => 'int not null comment "Идентификатор ингридиента"',
                'size' => 'bigint not null comment "Количество"',
            ]);

        $this->addForeignKey(self::FK_NAME, self::TABLE_NAME, self::FK_COLUMN, self::FK_TABLE_NAME, 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_NAME, self::TABLE_NAME);
        return $this->dropTable(self::TABLE_NAME);
    }
}
