<?php

use yii\db\Migration;

class m170301_192859_alter_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'last_login_at', $this->integer());
        $this->addColumn('user', 'role_id', "smallint DEFAULT '" . common\models\UserRole::USER_ROLE_BASE . "'");
        $this->alterColumn('user', 'status_id', "smallint DEFAULT '" . common\models\UserStatus::USER_STATUS_ACTIVE . "'");
    }

    public function down()
    {
        $this->dropColumn('user', 'last_login_at');
        $this->dropColumn('user', 'role_id');
        $this->alterColumn('user', 'status_id', "integer DEFAULT '10'");
    }
}
