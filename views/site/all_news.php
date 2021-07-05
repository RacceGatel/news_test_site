<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="news_box">
            <? if (count($news)>0)
            foreach ($news as $data) {
                ?>
                <div class="box col-lg-4">
                    <h2><?= $data['name'] ?></h2>

                    <p><?= $data['short'] ?></p>
                    <form method="post" action="<?=Url::toRoute([Yii::$app->params['city_url'].'/all_news'])?>">
                        <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>"/>
                        <p>
                            <a class="btn btn-default" href="<?=Url::toRoute([Yii::$app->params['city_url'].'/news?id='.$data['id']])?>">Подробнее</a>
                            <?
                            if(!Yii::$app->user->isGuest) {
                                if ($data["favourites_news"]['id_user'] == Yii::$app->user->getId())
                                    echo '<button type="submit" class="btn btn-danger" name="del_fav" value="' . $data['id'] . '">Удалить из избранных</button>';
                                else
                                    echo '<button type="submit" class="btn btn-warning" name="add_fav" value="' . $data['id'] . '">Добавить в избранное</button>';
                            }
                            ?>
                        </p>
                    </form>
                </div>
                <?
            }
            else
                echo '<h2>Ничего не найдено</h2>'
            ?>
        </div>
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
    </div>
</div>
