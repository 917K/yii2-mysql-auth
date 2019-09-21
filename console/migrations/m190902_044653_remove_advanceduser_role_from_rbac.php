<?php

use yii\db\Migration;

/**
 * Class m190902_044653_remove_advanceduser_role_from_rbac
 */
class m190902_044653_remove_advanceduser_role_from_rbac extends Migration
{
    /**
     * {@inheritdoc}
     * @desc это делается для того, чтобы не хранить
     * тысячи юзеров в RBAC, а хранить там только админов.
     * Роль продвинутого юзера будет храниться в \common\models\User
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        
        $perm = $auth->getPermission('advancedUserPermission');
        $auth->remove($perm);
        $role = $auth->getRole('advancedUserRole');
        $auth->remove($role);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // допуск для продвинутых юзеров
        $advancedUserPermission = $auth->createPermission('advancedUserPermission');
        $advancedUserPermission->description = 'Продвинутые возможности';
        $auth->add($advancedUserPermission);

        // роль продвинутого юзера
        $advancedUserRole = $auth->createRole('advancedUserRole');
        $advancedUserRole->description = 'Продвинутый юзер';
        $auth->add($advancedUserRole);
        $auth->addChild($advancedUserRole, $advancedUserPermission);
    }
}
