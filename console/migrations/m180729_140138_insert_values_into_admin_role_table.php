<?php

use yii\db\Migration;

class m180729_140138_insert_values_into_admin_role_table extends Migration
{
    public function up()
    {
        $this->insert('admin_role', [
            'title' => 'Base',
        ]);
        $this->insert('admin_role', [
            'id' => \backend\models\AdminRole::ADMIN_ROLE_SUPER,
            'title' => 'Super',
        ]);
    }

    public function down()
    {
        $this->delete('admin_role', ['id' => \backend\models\AdminRole::ADMIN_ROLE_SUPER]);
        $this->delete('admin_role', ['id' => 1]);
    }
}
