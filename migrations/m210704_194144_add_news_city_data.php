<?php

use yii\db\Migration;

/**
 * Class m210704_194144_add_news_city_data
 */
class m210704_194144_add_news_city_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%news_city}}',[
            'id_news' => '1',
            'id_city' => '2'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '3',
            'id_city' => '1'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '2',
            'id_city' => '3'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '4',
            'id_city' => '1'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '5',
            'id_city' => '1'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '6',
            'id_city' => '1'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '7',
            'id_city' => '1'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '7',
            'id_city' => '2'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '7',
            'id_city' => '3'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '8',
            'id_city' => '2'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '9',
            'id_city' => '1'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '9',
            'id_city' => '2'
        ]);
        $this->insert('{{%news_city}}',[
            'id_news' => '9',
            'id_city' => '3'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%city}}', [
            'id_news' => '1',
            'id_city' => '2'
        ]);
        $this->delete('{{%city}}', [
            'id_news' => '3',
            'id_city' => '1'
        ]);
        $this->delete('{{%city}}', [
            'id_news' => '2',
            'id_city' => '3'
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210704_194144_add_news_city_data cannot be reverted.\n";

        return false;
    }
    */
}
