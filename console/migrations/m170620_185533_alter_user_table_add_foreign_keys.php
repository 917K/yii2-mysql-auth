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
    }

    public function down()
    {
        return false;
    }
}
