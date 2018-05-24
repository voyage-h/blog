<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Like;
use app\models\Blog;
use app\models\Event;

class LikeController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['save'],
                'rules' => [
                    [
                        'actions' => ['save'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save' => ['post'],
                ],
            ],
        ];
    }

    /**
     *
     * Like an blog
     * @return int
     *
     */
    public function actionSave()
    {
        $uid = Yii::$app->user->id;
        $bid = Yii::$app->request->post('id');

        if($like = Like::find()->where(['user_id'=>$uid,'blog_id'=>$bid])->one()) {
            Event::destroy(Blog::className(),$like->blog_id,Event::LIKE,$like->id);
            Like::findOne($like->id)->delete();
            return -1;
        } else {

            $like = new Like();
            $like->user_id = $uid;
            $like->blog_id = $bid;
            $like->save();
            Event::create(Blog::className(),$like->blog_id,Event::LIKE,$like->id);
            return 1;
        }
    }

}
