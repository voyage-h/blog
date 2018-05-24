<?php
namespace app\widgets;

use Yii;
use app\models\User;
use app\models\Topic;
use yii\helpers\Url;

class MenuWidget extends \yii\bootstrap\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('@app/views/widget/menu');

        $data['topics'] = Topic::find()->orderBy('blog_count desc')->limit(6)->all();
        $data['users'] = User::find()->orderBy('created_at desc')->limit(6)->all();

        if (Yii::$app->user->isGuest) {
            
        } else {
        
            $con = Yii::$app->controller;
    
            $id = Yii::$app->user->id;
            if ($con->id == 'user' && $con->action->id == 'show') {
                $id = $con->actionParams['id'] ?? Yii::$app->user->id;
            }
            $data['user'] = User::findOne($id);
        }
        return $this->render('@app/views/widget/menu',$data);
    }
}
