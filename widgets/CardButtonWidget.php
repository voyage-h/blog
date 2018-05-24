<?php

namespace app\widgets;

use Yii;

class CardButtonWidget extends \yii\bootstrap\Widget
{
    public $blog;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $blog = $this->blog;
        return $this->render('@app/views/widget/card-btn',compact('blog'));

    }
}
