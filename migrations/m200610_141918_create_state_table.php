<?php

use yii\db\Migration;

/**
 * Handles the creation of table `state`.
 */
class m200610_141918_create_state_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('state', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'created_by' => $this->integer(11)->notNull(),
            'status' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(15)
        ]);
        $this->addForeignKey('fk_state_user_created_by', '{{%state}}', 'created_by', '{{%user}}', 'id');
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('state');
    }
}
