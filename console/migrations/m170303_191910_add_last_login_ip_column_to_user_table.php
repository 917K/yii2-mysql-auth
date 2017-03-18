<?php

use yii\db\Migration;

/**
 * Handles adding last_login_ip to table `user`.
 */
class m170303_191910_add_last_login_ip_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'last_login_ip', 'varbinary(16)');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'last_login_ip');
    }
}
