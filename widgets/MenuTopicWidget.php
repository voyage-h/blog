<?php

namespace app\widgets;

use Yii;
use app\models\Topic;
use yii\bootstrap\Html;

class MenuTopicWidget extends \yii\bootstrap\Widget
{
    public $topics;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $topics = $this->topics ?? Topic::page(1,5);
        if($topics) {
            return $this->render('@app/views/widget/menu-topic',compact('topics'));
        }
    }
}
