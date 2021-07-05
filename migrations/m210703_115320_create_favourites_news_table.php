<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favourites_news}}`.
 */
class m210703_115320_create_favourites_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favourites_news}}', [
            'id_user' => $this->integer()->notNull(),
            'id_news' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('id_fav', '{{%favourites_news}}', ['id_user', 'id_news']);

        $this->addForeignKey(
            'fk-favourites_news-id_user',
            'favourites_news',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-favourites_news-id_news',
            'favourites_news',
            'id_news',
            'news',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favourites_news}}');
    }
}
