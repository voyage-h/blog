<?php

namespace app\controllers;

use Yii;
use app\models\Comment;
use app\models\Blog;
use app\models\Event;


class EventController extends \yii\web\Controller
{

    public function actionShow($id)
    {
        $blog = Blog::find()->where(['id'=>$id])
            ->with(['events'=>function($q){$q->with([
                'user'=>function($q){$q->select('id,name,avatar');},
                'comment'
            ])->orderBy('id desc');}])->one();

        return $this->render('show',compact('blog'));
    }
}
