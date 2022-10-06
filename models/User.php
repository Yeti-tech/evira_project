<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;


class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * This is the model class for table "User".
     * @property string $username
     * @property string $password_hash
     * @property string $auth_key
     * @property integer $access_token
     * @property string $email
     * @property integer $cart_id
     * @property integer $account_id
     * @property int $id
     */

    //public $token;



    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->setAuthKey();
            }
            return true;
        }
        return false;
    }


    /**
     * @throws Exception
     */
    public function setAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString(5);
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @throws \Exception
     */
    public function setAccessToken()
    {
        $this->access_token = random_int(0, 99999);
        $this->save();
    }

    public function deleteOldPassword(): void
    {
        $this->password_hash = null;
        $this->save();
    }
    public function getAccessToken ()
    {
        return $this->access_token;
    }
    public function getPassword()
    {
        return $this->password_hash;
    }

    public static function register_user($registerForm):  User
    {
        $user = new self;
        $user->username = $registerForm->username;
        $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($registerForm->password);
        $user->email = $registerForm->email;
        $user->setAuthKey();
        if ($user->validate()) {
            $user->save();
        }
        return $user;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findUsername($id)
    {
       $model = static::findOne($id);
        return $model->getUsername();
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
    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmail(string $email): ?User
    {
        return static::findOne(['email' => $email]);
    }

    /**
     *
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
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
        $identity_hash = $this->getPassword();
        if (Yii::$app->getSecurity()->validatePassword($password, $identity_hash)) {
            return true;
        }
        return false;
    }


    /**
     * @throws \yii\db\StaleObjectException
     * @throws Exception
     */
    public function changePassword($new_password): bool
    {
        $password_hash = Yii::$app->getSecurity()->generatePasswordHash($new_password);
        if ($this->validate()) {
            $this->password_hash = $password_hash;
            $this->access_token = null;
            $this->update();
            return  true;
        }
        return false;
    }

    public function rules(): array
    {
        return [
            [['username'], 'string', 'max' => 15],
            [['username'], 'required'],
            [['password_hash'], 'string'],
            [['password_hash'], 'required'],
            [['auth_key'], 'unique'],
            [['access_token'], 'unique'],
            [['access_token'], 'integer'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['email'], 'required'],
            [['cart_id'], 'unique'],
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
