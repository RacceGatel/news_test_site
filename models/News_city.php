<?php


namespace app\models;


use yii\db\ActiveRecord;

class News_city extends ActiveRecord
{
    public function getNews() {
        return $this->hasOne(News::class, ['id' => 'id_news']);
    }

    public function getCity() {
        return $this->hasOne(City::class, ['id' => 'id_city']);
    }
}