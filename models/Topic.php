<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topics".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $blog_count
 * @property string $updated_at
 * @property string $created_at
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'blog_count'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'blog_count' => 'Blog Count',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getBlogs()
    {
        return $this->hasMany(Blog::className(),['id'=>'blog_id'])
            ->viaTable(TopicBlog::tableName(),['topic_id'=>'id']);        

    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function page($page, $pageSize = 10)
    {
        return Topic::find()->orderBy('blog_count desc')
            ->offset($page == 1 ? 0 : ($page - 1) * $pageSize)
            ->limit($pageSize)
            ->asArray()
            ->all();    
    }
}
