<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $auth_key
 * @property string $updated_at
 * @property string $created_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'email', 'password', 'avatar', 'auth_key'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'auth_key' => 'Auth Key',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email'=>$email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
        /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return  Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function setPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    //
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(),['user_id'=>'id']);
    }
    public function getComments()
    {
        return $this->hasMany(Comment::className(),['user_id'=>'id']);
    }

    public function isFollowed($id)
    {
        if (Follow::findOne(['user_id'=>Yii::$app->user->id,'followed_user_id'=>$id])) {
           if (Follow::findOne(['user_id'=>$id,'followed_user_id'=>Yii::$app->user->id])) {
               return "互相关注";
           }
           return "取消关注";
        }
        return "关注";
    }
}
