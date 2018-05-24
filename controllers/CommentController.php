<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Comment;
use app\models\Blog;
use app\models\Event;


class CommentController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['show'],
                'rules' => [
                    [
                        'actions' => ['save','delete'],
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
     * Display all comments
     * @param int id
     *
     * @return view/comment/show.php
     *
     */
    public function actionShow($id)
    {
        $blog = Blog::find()->where(['id'=>$id])->with(['user','comments'=>function($q){$q->orderBy('id desc');}])->one();
        return $this->render('show',['blog'=>$blog,'model'=>new Comment()]);

    }

    /**
     * Add a new comment
     * 
     * @return redirect
     *
     */
    public function actionSave()
    {
        $model = new Comment();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) &&  $model->save()) {
            Event::create(Blog::className(),$model->blog_id,Event::COMMENT,$model->id);

            return $this->redirect(Yii::$app->request->referrer);
        }        
        return $model->errors;
    }

    /**
     * Delete a comment
     *
     * @return redirect
     */
    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if($comment->user_id == Yii::$app->user->id) {
            Event::destroy(Blog::className(),$comment->blog_id,Event::COMMENT,$id);
            $comment->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}
