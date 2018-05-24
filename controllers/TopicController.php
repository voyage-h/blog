<?php

namespace app\controllers;

use Yii;
use app\models\Topic;
use yii\data\Pagination;

class TopicController extends \yii\web\Controller
{

    /** 
     * Display a topic
     * 
     * @param int id
     * @return render
     *
     */
    public function actionShow($id)
    {
        $topic = Topic::find()->with('blogs')->where(['id'=>$id])->one();
        return $this->render('show',compact('topic'));
    }

    /**
     * Display all topic lists
     *
     * @return Json
     *
     */
    public function actionList()
    {
        $size = 5;
        $page = Yii::$app->request->post('page') ?? 1;
        if (!($topics = Topic::page($page, $size) )) {
            $page = 1;
            $topics = Topic::page($page,$size);
        }

        return json_encode(compact('topics','page'));
    }
}
