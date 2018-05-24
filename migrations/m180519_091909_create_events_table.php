<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m180519_091909_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'target_type' => $this->string()->notNull(),
            'target_id' => $this->integer()->notNull(),
            'action_type' => $this->string()->notNull(),
            'action_id' => $this->integer(),
            'updated_at' => $this->timestamp().' DEFAULT now()',
            'created_at' => $this->timestamp().' DEFAULT now()',
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('events');
    }
}
