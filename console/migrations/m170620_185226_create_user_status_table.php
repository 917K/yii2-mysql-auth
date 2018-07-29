<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_status`.
 */
class m170620_185226_create_user_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_status', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_status');
    }
}
