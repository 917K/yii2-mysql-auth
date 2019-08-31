<?php

use yii\db\Migration;

/**
 * Class m190831_080414_add_more_rbac_roles
 */
class m190831_080414_add_more_rbac_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $roles = [
            // право управлять юзерами (кроме ролей)
            'adminManageUsersRole' => [
                'desc' => 'Админ юзеров',
                'perm' => [
                    'name' => 'adminManageUsersPermission',
                    'desc' => 'Управление юзерами (кроме ролей)',
                ]
            ],
            // право управлять ролями и видеть раздел Админы
            'adminManageRolesRole' => [
                'desc' => 'Админ ролей',
                'perm' => [
                    'name' => 'adminManageRolesPermission',
                    'desc' => 'Управление ролями',
                ]
            ],
        ];

        foreach ($roles as $roleName => $roleData) {
            $permission = $auth->createPermission($roleData['perm']['name']);
            $permission->description = $roleData['perm']['desc'];
            $auth->add($permission);
            
            $role = $auth->createRole($roleName);
            $role->description = $roleData['desc'];
            $auth->add($role);
            $auth->addChild($role, $permission);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190831_080414_add_more_rbac_roles cannot be reverted.\n";

        return false;
    }
}
