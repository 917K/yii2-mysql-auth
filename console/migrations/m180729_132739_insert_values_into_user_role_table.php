<?php

use yii\db\Migration;

class m180729_132739_insert_values_into_user_role_table extends Migration
{
    public function up()
    {
        $this->insert('user_role', [
            'title' => 'Base',
        ]);
        $this->insert('user_role', [
            'title' => 'Advanced',
        ]);
    }

    public function down()
    {
        $this->delete('user_role', ['id' => 2]);
        $this->delete('user_role', ['id' => 1]);
    }
}
