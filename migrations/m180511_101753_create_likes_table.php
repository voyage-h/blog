<?php

use yii\db\Migration;

/**
 * Handles the creation of table `likes`.
 */
class m180511_101753_create_likes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('likes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
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
        $this->dropTable('likes');
    }
}
