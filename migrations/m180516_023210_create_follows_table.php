<?php

use yii\db\Migration;

/**
 * Handles the creation of table `follows`.
 */
class m180516_023210_create_follows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('follows', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'followed_user_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp().' DEFAULT now()',
            'created_at' => $this->timestamp().' DEFAULT now()',
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('follows');
    }
}
