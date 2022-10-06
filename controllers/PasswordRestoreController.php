<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;

class PasswordRestoreController extends Controller
{
    public function actionIndex(): string
    {
        $user = new User;
        return $this->render('index', ['user' => $user]);
    }

    /**
     * @throws \JsonException
     */
    public function actionRestore() : string
    {
        if (isset($_POST['User']['email'])) {
            $user = User::findByEmail($_POST['User']['email']);
            if ($user) {
                $user->setAccessToken();
                if (ContactForm::emailPasswordRestore($user->email,  $user->getAccessToken())) {
                    return json_encode('email successfully sent', JSON_THROW_ON_ERROR);
                }
                return json_encode('invalid email', JSON_THROW_ON_ERROR);
            }
            return json_encode('this email is not registered', JSON_THROW_ON_ERROR);
        }
        return 'server validation error';
    }


    public function actionVertoken($token): string
    {
        $user = new User;
        if (isset($_POST['User']['password'])) {
            $user = User::findIdentityByAccessToken($token);
            if ($user && $user->access_token === $_POST['User']['access_token']) {
                $user->changePassword($_POST['User']['password']);
                LoginForm::loginAfterRegister($user->username, $_POST['User']['password']);
                return json_encode('password saved', JSON_THROW_ON_ERROR);
            }
            return json_encode('error', JSON_THROW_ON_ERROR);
        }
        return $this->render('reset', ['user' => $user, 'token' => $token,
        ]);
    }

}


