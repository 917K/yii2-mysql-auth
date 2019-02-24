<?php

use yii\db\Migration;

class m180722_202901_alter_user_admin_table extends Migration
{
    public function up()
    {
        $this->renameColumn(
            'user_admin',
            'user_role_admin_id',
            'admin_role_id'
        );

        // creates index for table user_admin, column `admin_role_id`
        $this->createIndex(
            'idx-user_admin-admin_role_id',
            'user_admin',
            'admin_role_id'
        );
    }

    public function down()
    {
        // drops index for column `admin_role_id`
        $this->dropIndex(
            'idx-user_admin-admin_role_id',
            'user_admin'
        );

        $this->renameColumn(
            'user_admin',
            'admin_role_id',
            'user_role_admin_id'
        );
    }
}
