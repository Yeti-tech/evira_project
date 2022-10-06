<?php

use yii\db\Migration;

/**
 * Class m220824_044608_renameColumnsUsersTable
 */
class m220824_044608_renameColumnsUsersTable extends Migration
{
    private $tableName = 'user';

    public function safeUp()
    {
        $this->renameColumn($this->tableName, 'password', 'password_hash');
        $this->renameColumn($this->tableName, 'accessToken', 'access_token');

    }


    public function safeDown()
    {
        echo "m220824_044608_renameColumnsUsersTable cannot be reverted.\n";

        return false;
    }

}
