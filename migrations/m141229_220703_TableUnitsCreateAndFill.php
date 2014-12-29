<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Создание таблицы единиц измерения для ингридиентов
 */
class m141229_220703_TableUnitsCreateAndFill extends Migration
{
    const TABLE_NAME = 'units';
    const FK_NAME = 'fk_units_measure';
    const FK_TABLE_NAME = 'measures';
    const FK_COLUMN = 'measure_id';
    const WEIGHT = 1;
    const VOLUME = 2;
    const DISTANCE = 3;

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
                'id' => 'pk comment "Идентификатор"',
                self::FK_COLUMN => 'int not null comment "Идентификатор меры"',
                'name' => 'string not null comment "Название единицы измерения"',
                /**
                 * Будет использоваться для перевода из одной величины в другую в
                 * рамках одной меры. Формула для перевода единиц:
                 * INGRIDIENTS.SIZEнов. = (INGRIDIENTS.SIZEтек. * RATIOтек.) / RATIOнов.
                 */
                'ratio' => 'bigint not null comment "Отношение"',
                /**
                 * Краткое обозначение единицы измерения
                 */
                'symbol' => 'string not null comment "Обозначение"',
            ]);

        $this->addForeignKey(self::FK_NAME, self::TABLE_NAME, self::FK_COLUMN, self::FK_TABLE_NAME, 'id', 'CASCADE', 'CASCADE');

        /**
         * МЕРЫ ВЕСА
         */
        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::WEIGHT,
                'name' => 'грамм',
                'ratio' => 1,
                'symbol' => 'г',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::WEIGHT,
                'name' => 'килограмм',
                'ratio' => 1000,
                'symbol' => 'кг',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::WEIGHT,
                'name' => 'центнер',
                'ratio' => 100000,
                'symbol' => 'ц',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::WEIGHT,
                'name' => 'тонна',
                'ratio' => 1000000,
                'symbol' => 'т',
            ]);

        /**
        * МЕРЫ ОБЪЕМА
        */
        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::VOLUME,
                'name' => 'миллилитр',
                'ratio' => 1,
                'symbol' => 'мл',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::VOLUME,
                'name' => 'литр',
                'ratio' => 1000,
                'symbol' => 'л',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::VOLUME,
                'name' => 'кубический метр',
                'ratio' => 1000000,
                'symbol' => 'куб. м',
            ]);

        /**
        * МЕРЫ РАССТОЯНИЯ
        */
        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::DISTANCE,
                'name' => 'миллиметр',
                'ratio' => 1,
                'symbol' => 'мм',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::DISTANCE,
                'name' => 'метр',
                'ratio' => 1000,
                'symbol' => 'м',
            ]);

        $this->insert(self::TABLE_NAME, [
                'id' => null,
                'measure_id' => self::DISTANCE,
                'name' => 'километр',
                'ratio' => 1000000,
                'symbol' => 'км',
            ]);
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_NAME, self::TABLE_NAME);
        return $this->dropTable(self::TABLE_NAME);
    }
}
