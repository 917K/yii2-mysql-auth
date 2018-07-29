<?php

use yii\db\Migration;

class m170620_185533_alter_user_table_add_foreign_keys extends Migration
{
    public function up()
    {;
        $this->alterColumn(
            'user',
            'status_id',
            'integer'
        );

        $this->alterColumn(
            'user',
            'role_id',
            'integer'
        );

        // add foreign keys for table `user`
        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'user_role',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user-status_id',
            'user',
            'status_id',
            'user_status',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-user-status_id',
            'user'
        );

        $this->dropForeignKey(
            'fk-user-role_id',
            'user'
        );
    }
}
