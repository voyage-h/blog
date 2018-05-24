<?php
namespace app\widgets;

use Yii;

class AvatarWidget extends \yii\bootstrap\Widget
{
    public $user;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $user = $this->user;
        return $this->render('@app/views/widget/avatar',compact('user'));
    }
}
