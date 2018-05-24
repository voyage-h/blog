<?php
namespace app\widgets;

use Yii;
use app\models\User;

class MenuRecommendWidget extends \yii\bootstrap\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($users = User::find()->orderBy('created_at desc')->limit(6)->all() ) {
            return $this->render('@app/views/widget/menu-recommend',compact('users'));
        }
    }
}
