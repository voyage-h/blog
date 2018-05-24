<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $updated_at
 * @property string $created_at
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'blog_id'], 'required'],
            [['user_id', 'blog_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
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
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
    //increase like count
    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        $blog = Blog::findOne($this->blog_id);
        $blog->like_count++;
        return $blog->save();
    }
    //decrease like count
    public function afterDelete()
    {
        $blog = Blog::findOne($this->blog_id);
        $blog->like_count--;
        return $blog->save();
    }
    
}
