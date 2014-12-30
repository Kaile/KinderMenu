<?php

use yii\db\Schema;
use yii\db\Migration;

class m141230_191123_RenameConsistsToPortionsAndCreateRealConsists extends Migration
{
    const TABLE_PORTIONS    = 'portions';
    const TABLE_CONSISTS    = 'consists';
    const TABLE_DISHES      = 'dishes';
    const TABLE_INGRIDIENTS = 'ingridients';

    const FK_CONSISTS        = 'fk_dishes_consists';
    const FK_PORTIONS        = 'fk_consists_portions';
    const FK_DISHES          = 'fk_consists_dishes';
    const FK_INGRIDIENTS     = 'fk_consists_ingridients';
    const FK_NEW_INGRIDIENTS = 'fk_portions_ingridients';

    const FK_COLUMN_PORTIONS    = 'portion_id';
    const FK_COLUMN_DISHES      = 'dish_id';
    const FK_COLUMN_INGRIDIENTS = 'ingridient_id';

    const DISH_FK_COLUMN = 'consist_id';

    public function safeUp()
    {

        $this->dropForeignKey(self::FK_CONSISTS, self::TABLE_DISHES);

        $this->dropColumn(self::TABLE_DISHES, self::DISH_FK_COLUMN);

        $this->dropForeignKey(self::FK_INGRIDIENTS, self::TABLE_CONSISTS);

        $this->renameTable(self::TABLE_CONSISTS, self::TABLE_PORTIONS);

        $this->addForeignKey(self::FK_NEW_INGRIDIENTS, self::TABLE_PORTIONS, self::FK_COLUMN_INGRIDIENTS, self::TABLE_INGRIDIENTS, 'id', 'CASCADE', 'CASCADE');

        $this->createTable(self::TABLE_CONSISTS, [
                'id' => 'pk comment "Идентификатор"',
                self::FK_COLUMN_PORTIONS => 'int not null comment "Идентификатор порции"',
                self::FK_COLUMN_DISHES   => 'int not null comment "Идентификатор блюда"',
            ]);

        $this->addForeignKey(self::FK_DISHES, self::TABLE_CONSISTS, self::FK_COLUMN_DISHES, self::TABLE_DISHES, 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(self::FK_PORTIONS, self::TABLE_CONSISTS, self::FK_COLUMN_PORTIONS, self::TABLE_PORTIONS, 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_DISHES, self::TABLE_CONSISTS);
        $this->dropForeignKey(self::FK_PORTIONS, self::TABLE_CONSISTS);

        $this->dropTable(self::TABLE_CONSISTS);

        $this->dropForeignKey(self::FK_NEW_INGRIDIENTS, self::TABLE_PORTIONS);

        $this->renameTable(self::TABLE_PORTIONS, self::TABLE_CONSISTS);

        $this->addForeignKey(self::FK_INGRIDIENTS, self::TABLE_CONSISTS, self::FK_COLUMN_INGRIDIENTS, self::TABLE_INGRIDIENTS, 'id', 'CASCADE', 'CASCADE');

        $this->addColumn(self::TABLE_DISHES, self::DISH_FK_COLUMN, 'int not null comment "Идентификатор состава"');

        $this->addForeignKey(self::FK_CONSISTS, self::TABLE_DISHES, self::DISH_FK_COLUMN, self::TABLE_CONSISTS, 'id', 'CASCADE', 'CASCADE');
    }
}
