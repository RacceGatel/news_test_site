<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="news-content">
        <img src="/img/<?=$news['img']?>">

        <h2><?= $news['name'] ?></h2>

        <p><?= $news['text'] ?></p>

        <form method="post" action="<?=Url::toRoute([Yii::$app->params['city_url'].'/news?id='.$news['id']])?>">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>"/>
            <p>
                <?
                if(!Yii::$app->user->isGuest) {
                    if ($news["favourites_news"]['id_user'] == Yii::$app->user->getId())
                        echo '<button type="submit" class="btn btn-danger" name="del_fav" value="' . $news['id'] . '">Удалить из избранных</button>';
                    else
                        echo '<button type="submit" class="btn btn-warning" name="add_fav" value="' . $news['id'] . '">Добавить в избранное</button>';
                }
                ?>
            </p>
        </form>

        <h2>Похожие новости</h2>
         <?
            foreach($similar_news as $data)
            {
            ?>
            <div class="box col-lg-4">
                <h2><?=$data['name']?></h2>

                <p><?=$data['short']?></p>

                <a class="btn btn-default" href="<?=Url::toRoute([Yii::$app->params['city_url'].'/news?id='.$data['id']])?>">Подробнее</a>

            </div>
            <?
            }
            ?>
    </div>
</div>
