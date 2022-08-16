<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * This is the model class for table "User".
     *
     * @property int $id
     * @property string $username
     * @property string $password
     * @property string $auth_key
     * @property string $accessToken
     * @property string $email
     * @property integer $cart_id
     * @property integer $account_id
     *
     */

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->setAuthKey();
            }
            return true;
        }
        return false;
    }

    public static function register_user($registerForm, $password_hash): User
    {
        $user = new self;
        $user->username = $registerForm->username;
        $user->password = $password_hash;
        $user->email = $registerForm->email;
        $user->setAuthKey();
        if ($user->validate()) {
            $user->save();
        }
        return $user;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function setAuthKey(): string
    {
        return $this->auth_key = \Yii::$app->security->generateRandomString(5);
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return $this->password === $password;
    }

    public function rules(): array
    {
        return [
            [['username'], 'string', 'max' => 15],
            [['username'], 'required'],
            [['password'], 'string'],
            [['password'], 'required'],
            [['auth_key'], 'unique'],
            [['accessToken'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['email'], 'required'],
            [['cart_id'], 'unique'],
            [['cart_id'], 'unique'],
        ];
    }
}
