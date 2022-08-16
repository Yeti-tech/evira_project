<?php


namespace app\controllers;


use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;


class RegisterFormController extends Controller
{

    public function actionIndex(): string
    {
        $registerForm = new registerForm;
        if (isset($_POST['RegisterForm'])) {
            $request = Yii::$app->request;
            $post = $request->post();
            $registerForm->username = Html::encode($post['RegisterForm']['username']);
            $registerForm->password = Html::encode($post['RegisterForm']['password']);
            $password_hash = Yii::$app->getSecurity()->generatePasswordHash($registerForm->password);
            $registerForm->email = Html::encode($post['RegisterForm']['email']);

            if ($registerForm->validate()) {
                User::register_user($registerForm, $password_hash);

                LoginForm::loginAfterRegister($registerForm->username, $password_hash);
                $this->goHome();

            } else {
                $errors = $registerForm->errors;
                // здесь вывести ошибку
            }
        }
        return $this->render('index',
            ['model' => $registerForm]);
    }

    public function actionLogout(): \yii\web\Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionTest(): string
    {
        return $this->render('test'
        );
    }
}
