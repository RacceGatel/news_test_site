<?php

use yii\db\Migration;

/**
 * Class m210703_113000_add_user_data
 */
class m210703_113000_add_user_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => 'admin',
            'email' => 'admin@admin.ru',
            'status' => 10,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', [
            'username' => 'admin',
        ]);
    }


}
