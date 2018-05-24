<?php

use yii\db\Migration;

/**
 * Handles the creation of table `topics`.
 */
class m180515_093549_create_topics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('topics', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'blog_count' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->timestamp().' DEFAULT now()',
            'created_at' => $this->timestamp().' DEFAULT now()',
             ],'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('topics');
    }
}
