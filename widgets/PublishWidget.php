<?php
namespace app\widgets;

use Yii;

class PublishWidget extends \yii\bootstrap\Widget
{
    public $blogs;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('@app/views/widget/publish');

    }
}
