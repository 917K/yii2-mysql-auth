<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_admin_role`.
 */
class m170611_095643_create_user_admin_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_admin_role', [
            'id' => $this->primaryKey(),
            'role' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_admin_role');
    }
}
