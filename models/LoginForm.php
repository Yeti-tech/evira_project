<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            [['username', 'password'], 'trim'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * /
     * /**
     *
     *
     * public function validatePassword($attribute, $params)
     * {
     * if (!$this->hasErrors()) {
     * $user = $this->getUser();
     *
     * if (!$user || !$user->validatePassword($this->password)) {
     * $this->addError($attribute, 'Incorrect username or password.');
     * }



     * /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        $session = Yii::$app->session;
        $session->open();
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 300 : 0);
        }
        return false;
    }


    /**
     * Validates the password.
     * This method serves as the validation for password.
     */

    public function validatePassword(): bool
    {
         if (!$this->hasErrors()) {
             $user = $this->getUser();
             if (!$user || !$user->validatePassword($this->password)) {
                 $this->addError('password', 'Incorrect password');
                 return false;
             }
             return true;
         }
      return false;
    }

    public static function loginAfterRegister($username, $password_hash): void
    {
        $loginForm = new self();
        $loginForm->password = $password_hash;
        $loginForm->username = $username;
        $loginForm->login();
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }


    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль'];
    }

}
