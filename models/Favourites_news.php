<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Favourites_news extends ActiveRecord
{
    public static function tableName()
    {
        return 'favourites_news';
    }

    public function getNews()
    {
        return $this->hasMany(News::class, ['id' => 'id_news']);
    }
}