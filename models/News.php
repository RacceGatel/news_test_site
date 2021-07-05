<?php


namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public function getFavourites_news()
    {
        return $this->hasOne(Favourites_news::class, ['id_news' => 'id']);
    }

    public function getNews_city()
    {
        return $this->hasMany(News_city::class, ['id_news' => 'id']);
    }
}