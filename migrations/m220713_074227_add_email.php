<?php

use yii\db\Migration;

/**
 * Class m220713_074227_add_email
 */
class m220713_074227_add_email extends Migration
{
   private $tableName = 'User';

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'email', 'string');
    }

    public function safeDown()
    {
        echo "m220713_074227_add_email cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220713_074227_add_email cannot be reverted.\n";

        return false;
    }
    */
}
