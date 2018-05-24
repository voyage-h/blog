<?php

namespace app\widgets;

use Yii;

class CardImageWidget extends \yii\bootstrap\Widget
{
    public $imgs;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $imgs = $this->imgs;
        return $this->render('@app/views/widget/card-image',compact('imgs'));

        $img_html = '';
        foreach(json_decode($this->imgs) as $img) {
            $img_html .= "<img src='/images/upload/$img'>";
        }
        return "<p class='card-img'>$img_html</p>";
    }
}
