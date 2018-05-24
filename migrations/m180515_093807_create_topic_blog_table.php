<?php

use yii\db\Migration;

/**
 * Handles the creation of table `topic_blog`.
 */
class m180515_093807_create_topic_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('topic_blog', [
            'id' => $this->primaryKey(),
            'topic_id' => $this->integer()->notNull(),
            'blog_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp().' DEFAULT now()',
            'created_at' => $this->timestamp().' DEFAULT now()',
             ],'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('topic_blog');
    }
}
