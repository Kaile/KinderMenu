<?php

use yii\db\Schema;
use yii\db\Migration;

class m141229_152754_TableIngestionsCreate extends Migration
{
    const TABLE_NAME = 'ingestions';

    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
                'id'        => 'pk comment "Идентификатор"',
                'name'      => 'string not null comment "Название"',
                'position'  => 'int not null comment "Позиция"',
            ]);

        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Завтрак',        'position' => 1000]);
        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Второй завтрак', 'position' => 2000]);
        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Обед',           'position' => 3000]);
        $this->insert(self::TABLE_NAME, ['id' => null, 'name' => 'Полдник',        'position' => 4000]);
    }

    public function down()
    {
        return $this->dropTable(self::TABLE_NAME);
    }
}
