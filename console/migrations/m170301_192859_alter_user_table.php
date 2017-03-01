<?php

use yii\db\Migration;
use common\models\User;

class m170301_192859_alter_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'last_login_at', $this->integer());
        $this->addColumn('user', 'role', "smallint DEFAULT '" . User::ROLE_DEFAULT . "'");
        $this->alterColumn('user', 'status', "smallint DEFAULT '" . User::STATUS_ACTIVE . "'");
    }

    public function down()
    {
        $this->dropColumn('user', 'last_login_at');
        $this->dropColumn('user', 'role');
        $this->alterColumn('user', 'status', "integer DEFAULT '10'");
    }
}
