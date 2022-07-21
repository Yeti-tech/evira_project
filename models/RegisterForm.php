<?php

namespace app\models;

use ReflectionClass;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 */
class RegisterForm extends Model
{

    public $username;
    public $password;
    public $email;

    public function rules(): array
    {
        return [
            [['username'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 10],
            [['email'], 'email'],
            [['email'], 'required', 'message' => 'Please choose an email.'],
            [['username'], 'required', 'message' => 'Please choose a username.'],
            [['password'], 'required', 'message' => 'Please choose a password.'],
            [['username', 'email', 'password'], 'trim'],
        ];
    }
    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Email',

        ];
    }
}
