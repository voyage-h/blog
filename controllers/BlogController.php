<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Blog;
use app\models\Like;
use app\models\Event;
use app\models\UploadForm;
use yii\web\UploadedFile;

class BlogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['index','hot'],
                'rules' => [
                    [
                        'actions' => ['index','hot'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($page = 1)
    {
        return $this->render('index', Blog::page($page));
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionHot($page = 1)
    {
        return $this->render('hot', Blog::page($page,['sort'=>'popularity_count desc']));
    }
    public function actionStore()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Blog();
        if($filenames = Yii::$app->request->post('filenames')) {
            $model->img = json_encode($filenames);
        }
        if ($model->load(Yii::$app->request->post()) &&  $model->save()) {

            Event::create(Blog::className(),$model->id, Event::PUBLISH);

            return $this->goBack();
        }
        dd($model->errors);
    }
    /**
     * repost a blog
     *
     *
     *
     */
    public function actionRepost()
    {
        if ($repost_blog = Blog::findOne(Yii::$app->request->post('Blog')['id'])) {

            //origin blog
            if ($repost_blog->origin_id != $repost_blog->id && ($origin_blog = Blog::findOne($repost_blog->origin_id))) {
                $origin_blog->repost_count++;
                $origin_blog->save();
                Event::create(Blog::className(),$origin_blog->id, Event::REPOST);
            }

            //repost blog
            $repost_blog->repost_count++;
            $repost_blog->origin_id ?? $repost_blog->origin_id = $repost_blog->id;
            $repost_blog->save();
            Event::create(Blog::className(),$repost_blog->id, Event::REPOST);

            $model = new Blog();
            $model->user_id = Yii::$app->user->id;
            $model->parent_id = $repost_blog->id;
            $model->origin_id = $repost_blog->origin_id;

            if ($model->load(Yii::$app->request->post()) &&  $model->save()) {
                Event::create(Blog::className(),$model->id, Event::PUBLISH);

                return $this->goBack();
            }
        }
        dd($model->errors);
    }
    public function actionDelete($id)
    {
        $blog = Blog::findOne($id);
        if ($blog->user_id == Yii::$app->user->id) {
            Event::destroy(Blog::className(),$model->id, Blog::className());
            $blog->delete();
        }
        return $this->goHome();
    }
}
