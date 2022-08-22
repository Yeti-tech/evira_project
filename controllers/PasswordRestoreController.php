<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\PasswordRestore;
use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;

class PasswordRestoreController extends Controller
{
    public function actionIndex()
    {
        $passwordRestore = new passwordRestore;
        // $post = $request->post();

        return $this->render('index', ['passwordRestore' => $passwordRestore]);
    }

    /**
     * @throws \JsonException
     */
    public function actionRestore()
    {
        $passwordRestore = new passwordRestore;
        //$res = json_decode($post, true);
        // $passwordRestore->email = Html::encode($res['email']);
        //  $passwordRestore->email = Html::encode($_POST['PasswordRestore']['email']);
        if (isset($_POST['PasswordRestore']['email'])) {
            $passwordRestore->email = $_POST['PasswordRestore']['email'];
            if ($passwordRestore->validate()) {
                $user = User::findByEmail($passwordRestore->email);
                if ($user) {
                    $user->setAccessToken();
                    if (ContactForm::emailPasswordRestore($passwordRestore->email, $user->getAccessToken())) {
                        return json_encode('email successfully sent', JSON_THROW_ON_ERROR);
                    }
                    return json_encode('invalid email', JSON_THROW_ON_ERROR);
                }
                return json_encode('this email is not registered', JSON_THROW_ON_ERROR);
            }
            return 'server validation error';
        }
    }


    public function actionVertoken($token)
    {
        $passwordRestore = $this->getToken($token);
        if(isset($_POST['Ganti']))
        {
            if($model->token==$_POST['Ganti']['tokenhid']){
                $model->password=md5($_POST['Ganti']['password']);
                $model->token="null";
                $model->save();
                Yii::app()->user->setFlash('ganti','<b>Password has been successfully changed! please login</b>');
                $this->redirect('?r=site/login');
                $this->refresh();
            }
        }
        return $this->render('index', ['passwordRestore' => $passwordRestore]);
    }

}


