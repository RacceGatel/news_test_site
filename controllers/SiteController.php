<?php

namespace app\controllers;

use app\models\City;
use app\models\Favourites_news;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\News;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    public function beforeAction($action)
    {
        $city = Yii::$app->request->resolve()[1]['city'];

        if($city != null) {
            $f_city = City::find()->where(['url_name' => $city])->one();

            if($f_city != null) {
                Yii::$app->params['city_id'] = $f_city['id'];
                Yii::$app->params['city_url'] = $city;
                Yii::$app->params['city_name'] = $f_city['name'];
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays main page.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->request->post('del_fav')!=null)
                $this->delFavouriteNews(Yii::$app->request->post('del_fav'));

            $qr = News::find()->joinWith('news_city',true, 'INNER JOIN')
                ->joinWith('favourites_news', true, 'LEFT JOIN')
                ->where(['id_city' => Yii::$app->params['city_id']])
                ->andWhere(['id_user'=>Yii::$app->user->getId()])
                ->orderBy('name');

            $pages=new Pagination(['totalCount' => $qr->count(), 'pageSize' => 6,
                'pageSizeParam' => false, 'forcePageParam' => false]);

            $news = $qr->offset($pages->offset)->limit($pages->limit)->all();
        }

        return $this->render('index', compact('news', 'pages'));
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays all news page.
     *
     * @return Response|string
     */
    public function actionAll_news($search = null)
    {
        if(Yii::$app->request->post('add_fav')!=null)
            $this->addFavouriteNews(Yii::$app->request->post('add_fav'));
        else
        if(Yii::$app->request->post('del_fav')!=null)
            $this->delFavouriteNews(Yii::$app->request->post('del_fav'));

        $qr = null;
        isset($search) ? $qr = News::find()->joinWith('news_city',true, 'INNER JOIN')
            ->where(['id_city' => Yii::$app->params['city_id']])->andWhere(['like', 'name', '%'.$search.'%', false])
            :
            $qr = News::find()->joinWith('news_city',true, 'INNER JOIN')
                ->where(['id_city' => Yii::$app->params['city_id']]);

        $pages = new Pagination(['totalCount' => $qr->count(), 'pageSize' => 4,
            'pageSizeParam' => false, 'forcePageParam' => false]);

        $news = $qr->offset($pages->offset)->limit($pages->limit)
            ->joinWith('favourites_news', true, 'LEFT JOIN')
            ->orderBy('name')->all();

        return $this->render('all_news', compact('news', 'pages'));
    }

    /**
     * Displays news page.
     *
     * @return string
     */
    public function actionNews($id = null)
    {
        if(isset($id))
        {
            if(Yii::$app->request->post('add_fav')!=null)
                $this->addFavouriteNews(Yii::$app->request->post('add_fav'));
            else
                if(Yii::$app->request->post('del_fav')!=null)
                    $this->delFavouriteNews(Yii::$app->request->post('del_fav'));

            $news = News::find()->where(['id'=>$id])
                ->joinWith('favourites_news', true, 'LEFT JOIN')
                ->one();
            if($news == [])
            {
                throw new NotFoundHttpException;
            }

            $similar_news = News::find()->joinWith('news_city',true, 'INNER JOIN')
                ->orderBy('RAND()')
                ->where(['id_city' => Yii::$app->params['city_id']])
                ->andWhere(['not in', 'id', $id])
                ->limit(3)->all();
            return $this->render('news', compact('news', 'similar_news'));
        }
        else
        {
            throw new NotFoundHttpException;
        }

    }

    /**
     * Add to fav.
     *
     * @return true
     */
    public function addFavouriteNews($id)
    {
        $favourite = new Favourites_news();
        $favourite->id_user = Yii::$app->user->getId();
        $favourite->id_news = $id;
        $favourite->save();
        return true;
    }


    /**
     * Delete from fav.
     *
     * @return true
     */
    public function delFavouriteNews($id)
    {
        Favourites_news::find()->where(['id_user'=>Yii::$app->user->getId(),
            'id_news'=>$id])->one()->delete();
        return true;
    }
}
