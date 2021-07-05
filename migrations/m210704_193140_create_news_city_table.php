<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_city}}`.
 */
class m210704_193140_create_news_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_city}}', [
            'id_news' => $this->integer()->notNull(),
            'id_city' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('id_fav', '{{%news_city}}', ['id_news', 'id_city']);

        $this->addForeignKey(
            'fk-news_city-id_news',
            'news_city',
            'id_news',
            'news',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-news_city-id_city',
            'news_city',
            'id_city',
            'city',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news_city}}');
    }
}
