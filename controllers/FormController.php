<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\base\Controller;
use yii\helpers\Html;


class FormController extends Controller
{

    /**
     * @throws \JsonException
     */
    public function actionDynlogin()
    {
        $model = new LoginForm();

        $request = Yii::$app->request;
        if ($request->isAjax) {
            $res = json_decode($_POST['data'], true);
            $model->username = Html::encode($res['username']);
            $model->password = Html::encode($res['password']);
            $model->rememberMe = Html::encode($res['rememberMe']);
            if ($model->login()) {
                return json_encode('login-completed', JSON_THROW_ON_ERROR);
            }
            $errors = $model->getErrors();
            return json_encode($errors, JSON_THROW_ON_ERROR);
          //  return json_encode('invalid_login', JSON_THROW_ON_ERROR);
        }
        return $this->render('../site/index');
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
