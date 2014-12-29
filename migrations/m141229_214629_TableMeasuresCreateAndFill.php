<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Создание таблицы для мер различных единиц измерения.
 * Меры позволяют разбить на категории единицы измерения, а также
 * позволяют проводить конвертацию единиц измерения в рамках одной
 * мерной группы.
 */
class m141229_214629_TableMeasuresCreateAndFill extends Migration
{

    const TABLE_NAME = 'measures';

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
                'id' => 'pk comment "Идентификатор"',
                'name' => 'string not null comment "Название меры"',
            ]);

        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Вес']);
        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Объем']);
        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Расстояние']);
    }

    public function down()
    {
        return $this->dropTable(self::TABLE_NAME);
    }
}
