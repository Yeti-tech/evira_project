<?php

use yii\db\Migration;

/**
 * Class m220713_152312_add
 */
class m220713_152312_add extends Migration
{

    private $tableName = 'User';

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'account_id', 'integer');
    }

    public function safeDown()
    {
        echo "m220713_152312_add cannot be reverted.\n";

        return false;
    }

}
