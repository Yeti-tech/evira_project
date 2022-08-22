<?php

namespace app\models;

use yii\base\Model;

class PasswordRestore extends Model
{

    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'trim'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(): array
    {
        return [
            'email' => 'Email',

        ];
    }

}