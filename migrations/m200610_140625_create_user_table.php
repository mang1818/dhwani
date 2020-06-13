<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m200610_140625_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)->notNull(),
            'designation' => $this->string(255)->notNull(),
            'organization' => $this->string(255),
            'status' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
