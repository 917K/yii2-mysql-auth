<?php

use yii\db\Migration;

class m190728_090617_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // допуск для продвинутых юзеров
        $advancedUserPermission = $auth->createPermission('advancedUserPermission');
        $advancedUserPermission->description = 'Продвинутые возможности';
        $auth->add($advancedUserPermission);

        // роль продвинутого юзера
        $advancedUserRole = $auth->createRole('advancedUserRole');
        $auth->add($advancedUserRole);
        $auth->addChild($advancedUserRole, $advancedUserPermission);

        // допуск для админов
        $adminBasePermission = $auth->createPermission('adminBasePermission');
        $adminBasePermission->description = 'Разрешение на вход в админку';
        $auth->add($adminBasePermission);

        // базовая админская роль с возможностью входа в админку
        $adminRole = $auth->createRole('adminBaseRole');
        $auth->add($adminRole);
        $auth->addChild($adminRole, $adminBasePermission);
        
        // назначить первому юзеру роль админа и продвинутого
        $auth->assign($advancedUserRole, 1);
        $auth->assign($adminRole, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
