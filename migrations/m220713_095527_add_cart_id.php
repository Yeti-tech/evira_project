<?php

use yii\db\Migration;

/**
 * Class m220713_095527_add_cart_id
 */
class m220713_095527_add_cart_id extends Migration
{
   private $tableName = 'User';

    public function safeUp()
    {
$this->addColumn($this->tableName, 'cart_id', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220713_095527_add_cart_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220713_095527_add_cart_id cannot be reverted.\n";

        return false;
    }
    */
}
