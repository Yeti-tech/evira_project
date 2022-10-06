<?php


namespace app\controllers;


use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;


class RegisterFormController extends Controller
{

    public function actionIndex(): string
    {
        $registerForm = new registerForm;

        return $this->render('index',
            ['model' => $registerForm]);
    }

    /**
     * @throws \JsonException
     */
    public function actionRegister()
    {
        $registerForm = new registerForm;
        if (isset($_POST['data'])) {
            $decoded_POST = json_decode($_POST['data'], true, 512, JSON_THROW_ON_ERROR);
            return $registerForm->ajaxRegister($decoded_POST);
        }

        return $this->render('index',
          ['model' => $registerForm]);
    }

    public function actionLogout(): \yii\web\Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionTest()
    {
        return $this->render('test',
            );
    }
}
