<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220701_095115_create_user_table extends Migration
{

    private $tableName = 'user';
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'auth_key' => $this->string(),
            'username' => $this->string(),
            'password' =>$this->string(),
            'accessToken' =>$this->string(),
        ]);
    }


    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
