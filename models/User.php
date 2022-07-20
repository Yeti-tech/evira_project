<?php

namespace app\models;

use ReflectionClass;
use yii\db\ActiveRecord;

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
     */

    private $id;
    private $user_name;
    private $user_password;
    private $user_authKey;
    private $user_accessToken;
    private $user_email;
    private $user_cart_id;
    private $user_account_id;


   public function __construct(string $username, string $password, string $email, $config = [])
    {
        $this->user_name = $username;
        $this->user_password = $password;
        $this->user_email = $email;
        parent::__construct($config);
        $this->beforeSave(true);
    }

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    }
    public static function tableName(): string
    {
        return 'user';
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

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->user_authKey;
    }

    public function setAuthKey(): string
    {
        return $this->user_authKey = \Yii::$app->security->generateRandomString(5);
    }
    public function validateAuthKey($authKey): bool
    {
        return $this->user_authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return $this->user_password === $password;
    }


    public function beforeSave($insert): bool
    {
        return $this->password === $password;
    }
}
