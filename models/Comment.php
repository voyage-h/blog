<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $content
 * @property int $parent_id
 * @property string $updated_at
 * @property string $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'blog_id', 'content'], 'required'],
            [['user_id', 'blog_id', 'parent_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'blog_id' => 'Blog ID',
            'content' => 'Content',
            'parent_id' => 'Parent ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getParent()
    {
        return $this->hasOne(User::className(),['id'=>'parent_id']);
    }
    //increase comment_count
    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        $blog = Blog::findOne($this->blog_id);
        $blog->comment_count++;
        return $blog->save();
    }
    //decrease comment count
    public function afterDelete()
    {
            $blog = Blog::findOne($this->blog_id);
            $blog->comment_count--;
            return $blog->save();
    }
}
