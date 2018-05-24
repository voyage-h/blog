<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blogs`.
 */
class m180510_020827_create_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blogs', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'origin_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'trend_count' => $this->integer()->notNull()->defaultValue(0),
            'repost_count' => $this->integer()->notNull()->defaultValue(0),
            'like_count' => $this->integer()->notNull()->defaultValue(0),
            'comment_count' => $this->integer()->notNull()->defaultValue(0),
            'text' => $this->string(),
            'img' => $this->json(),
            'updated_at' => $this->timestamp().' DEFAULT now()',
            'created_at' => $this->timestamp().' DEFAULT now()',
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blogs');
    }
}
