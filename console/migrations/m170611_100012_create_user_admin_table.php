<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_admin`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user_admin_role`
 */
class m170611_100012_create_user_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_admin', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'user_role_admin_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_admin-user_id',
            'user_admin',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_admin-user_id',
            'user_admin',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_admin-user_id',
            'user_admin'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_admin-user_id',
            'user_admin'
        );

        $this->dropTable('user_admin');
    }
}
