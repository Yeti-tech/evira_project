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
        if ( isset($_POST['RegisterForm'])) {
            $request = Yii::$app->request;
            $post = $request->post();

            if ($registerForm->load($post) && $registerForm->validate()) {

                User::register_user($registerForm);
                $loginForm = new LoginForm();
                $loginForm->username = Html::encode ($post['RegisterForm']['username']);
                $loginForm->password = Html::encode ($post['RegisterForm']['password']);
                $loginForm->login();
                $this->goHome();
            } else {
                $errors = $registerForm->errors;
                // здесь вывести ошибку
            }
        }
       return $this->render('index',
            ['model' => $registerForm]);
    }

}
