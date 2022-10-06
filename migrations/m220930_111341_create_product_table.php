<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m220930_111341_create_product_table extends Migration
{

    private $tableName = 'product';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(), 'name' => $this->string(80)->notNull(), 'description' => $this->string(500)->notNull()->comment('full description'),
            'summary' => $this->string(150)->comment('short description'), 'date' => $this->date()->comment('the date that the product was added to the store'),
            'date_modified' => $this->date()->comment(' the date that the product was last updated.'), 'categories' => $this->string(50)->notNull(),
            'tags' => $this->string(50)->notNull(), 'image' => $this->string(), 'reviews' => $this->string(), 'stock' => $this->integer(5)->comment('the current stock level for the product'),
            'weight' => $this->decimal(18,4), 'price' => $this->decimal(18,4), 'buy' => $this->string()->comment('the Add to Cart button for the product'),
            'button' => $this->string()->comment(' a button in the table which links to the product detail page'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
