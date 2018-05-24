<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Follow;

class FollowController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['user'],
                'rules' => [
                    [
                        'actions' => ['user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionUser($id)
    {
        if (Yii::$app->user->id != $id) {
            $follow = Follow::findOne(['user_id'=>Yii::$app->user->id,'followed_user_id'=>$id]);

            if ($follow) {
                $follow->delete();
            } else {
                $follow = new Follow();
                $follow->user_id = Yii::$app->user->id;
                $follow->followed_user_id = $id;
                $follow->save();
            }
        }
         return $this->redirect(Yii::$app->request->referrer);
    }

}
