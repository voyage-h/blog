<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $name;
    public $password;
    public $repeat_password;
    public $email;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
//            [['name', 'password','email','repeat_password'], 'required'],
//            [['password','repeat_password'], 'validatePassword'],
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\app\models\User', 'message' => '用户名已经存在'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => '邮箱已经存在'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
            
            ['repeat_password', 'required'],
            ['repeat_password', 'string', 'min' => 6],
            ['repeat_password', 'validatePassword'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
            'repeat_password' => '重复密码'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        //判断密码是否相同
        if ($this->password != $this->repeat_password) {
            $this->addError($attribute,'两次密码不相同');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = User::setPassword($this->password);
       
        return $user->save() ? $user : null;
    }
}
