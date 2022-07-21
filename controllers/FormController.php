<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\base\Controller;
use yii\helpers\Html;


class FormController extends Controller
{

    public function actionDynlogin()
    {
        $model = new LoginForm();

        $request = Yii::$app->request;
        if ($request->isAjax) {
            $result = $_POST['data'];
            $res = json_decode($result, true);
            $model->username = Html::encode($res['username']);
            $model->password = Html::encode($res['password']);
            $model->rememberMe = Html::encode($res['rememberMe']);
            if ($model->login()) {
             $result = 'true';
                return $result;
            }
            $result = 'false';
            return $result;
        }
        }

    public function actionDynlogout()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->user->logout(true);
            //$this->goHome();
            $result = 'true';
                return $result;
            }
            $result = 'false';
            return $result;
    }

    public function goHome()
    {
        return $this->response->redirect(Yii::$app->getHomeUrl());
    }

}
