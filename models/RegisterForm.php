<?php

namespace app\models;

use ReflectionClass;
use yii\base\Model;
use yii\helpers\Html;

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
            [['email'], 'required'],
            [['username'], 'required'],
            [['password'], 'required'],
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

    public function ajaxRegister($decoded_POST)
    {
        $this->username = Html::encode($decoded_POST['username']);
        $this->password = Html::encode($decoded_POST['password']);
        $this->email = Html::encode($decoded_POST['email']);

        if ($this->validate()) {
             User::register_user($this);
           LoginForm::loginAfterRegister($this->username, $this->password);
            return json_encode('register-completed', JSON_THROW_ON_ERROR);
        }
        $errors = $this->getErrors();
        return json_encode($errors, JSON_THROW_ON_ERROR);
    }
}
