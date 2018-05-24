<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class Admin extends ActiveRecord
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $authKey;
    public $remember_token;

    public static function tableName()
    {
        return 'users';
    }
}
