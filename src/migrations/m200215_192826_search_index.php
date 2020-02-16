<?php

use floor12\searchpg\enum\Language;
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
            'tsvector' => $this->getDb()->getSchema()->createColumnSchemaBuilder('tsvector')->notNull(),
            'lang' => $this->text(2)->notNull()->defaultValue(Language::ENGLISH)
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
