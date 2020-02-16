<?php

use yii\db\Migration;

/**
 * Class m200215_192826_search_index
 */
class m200215_192826_search_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%search_index}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'url' => $this->string()->notNull(),
            'indexed' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'tsvector' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%search_index}}');
    }
}
