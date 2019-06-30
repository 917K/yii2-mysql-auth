<?php

use yii\db\Migration;

/**
 * Handles altering last_login_ip from table `user`.
 */
class m190617_094617_alter_last_login_ip_column_from_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->alterColumn('user', 'last_login_ip', 'varchar(45)');
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->alterColumn('user', 'last_login_ip', $this->varbinary(16));
    }
}
