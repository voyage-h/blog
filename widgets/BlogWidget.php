<?php
namespace app\widgets;

use Yii;
use app\models\Blog;

class BlogWidget extends \yii\bootstrap\Widget
{
    public $blogs;
    public $pagination;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $blogs = $this->blogs;
        $pagination = $this->pagination;

        return $this->render('@app/views/widget/blog', compact('blogs','pagination'));
    }
}
