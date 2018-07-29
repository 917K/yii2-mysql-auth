<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin_role`.
 */
class m180722_200318_create_user_role_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin_role', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin_role');
    }
}
