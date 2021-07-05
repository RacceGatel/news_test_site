<?php


namespace app\models;


use yii\db\ActiveRecord;

class City extends ActiveRecord
{
    public function getNews_city()
    {
        return $this->hasMany(News_city::class, ['id_city' => 'id']);
    }
}