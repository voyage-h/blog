<?php

namespace app\widgets;

use Yii;
use app\models\Topic;
use yii\bootstrap\Html;

class PublishFormWidget extends \yii\bootstrap\Widget
{
    public $options;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $options = $this->options;
        return $this->render('@app/views/widget/publish-form',compact('options'));
    }
}
