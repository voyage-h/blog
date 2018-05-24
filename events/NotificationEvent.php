<?php

namespace app\events;

class NotificationEvent extends \yii\base\Component
{
    const BLOG_LIKE = '关注';
    const BLOG_COMMENT = '评论';

    public function fire()
    {
        dd(3);
    }

}
