<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `user_role`.
 */
class m170620_185208_create_user_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_role', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_role');
    }
}
