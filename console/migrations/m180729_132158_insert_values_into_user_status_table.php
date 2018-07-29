<?php

use yii\db\Migration;

class m180729_132158_insert_values_into_user_status_table extends Migration
{
    public function up()
    {
        $this->insert('user_status', [
            'title' => 'Active',
        ]);
        $this->insert('user_status', [
            'title' => 'Banned',
        ]);
        $this->insert('user_status', [
            'title' => 'Inactive',
        ]);
    }

    public function down()
    {
        $this->delete('user_status', ['id' => 3]);
        $this->delete('user_status', ['id' => 2]);
        $this->delete('user_status', ['id' => 1]);
    }
}
