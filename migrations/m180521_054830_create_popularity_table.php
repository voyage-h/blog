<?php

use yii\db\Migration;

/**
 * Handles the creation of table `popularity`.
 */
class m180521_054830_create_popularity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('popularity', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('popularity');
    }
}
