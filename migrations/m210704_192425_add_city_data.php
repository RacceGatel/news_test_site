<?php

use yii\db\Migration;

/**
 * Class m210704_192425_add_city_data
 */
class m210704_192425_add_city_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%city}}',[
            'name' => 'Уфа',
            'url_name' => 'ufa',
        ]);
        $this->insert('{{%city}}',[
            'name' => 'Москва',
            'url_name' => 'moscow',
        ]);
        $this->insert('{{%city}}',[
            'name' => 'Санкт-Петербург',
            'url_name' => 's-petersburg',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%city}}', ['in', 'name', [
            'Уфа',
            'Москва',
            'Санкт-Петербург',
        ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210704_192425_add_city_data cannot be reverted.\n";

        return false;
    }
    */
}
