<?php

use yii\db\Schema;
use yii\db\Migration;

class m150112_193536_TableMenuConsistsCreate extends Migration
{
    const TABLE_NAME = 'menu_consists';

    protected $table_refs = ['dishes', 'ingestions', 'menus'];
    protected $column_refs = ['dish_id', 'ingestion_id', 'menu_id'];
    protected $fk_refs = ['fk_menu-consist_dishes', 'fk_menu-consist_ingestions', 'fk_menu-consist_menus'];

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => 'pk comment "Идентификатор"',
            $this->column_refs[0] => 'int not null comment "Идентификатор блюда"',
            $this->column_refs[1] => 'int not null comment "Идентификатор приема пищи"',
            $this->column_refs[2] => 'int not null comment "Идентификатор меню"',
        ]);

        for ($i = 0; $i < count($this->table_refs); ++$i) {
            $this->addForeignKey($this->fk_refs[$i], self::TABLE_NAME, $this->column_refs[$i], $this->table_refs[$i], 'id', 'CASCADE', 'CASCADE');
        }

    }

    public function down()
    {
        return $this->dropTable(self::TABLE_NAME);

    }
}
