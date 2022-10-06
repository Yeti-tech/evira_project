<?php

namespace app\controllers;

use app\models\LoginForm;
use yii\base\Controller;



class LoginFormController extends Controller
{
    /**
     * @throws \JsonException
     * Logs in the user using input data.
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($_POST['data']) {
            $decoded_POST = json_decode($_POST['data'], true, 512, JSON_THROW_ON_ERROR);
            return $model->ajaxLogin($decoded_POST);
        }
        return $this->render('../site/index');
        }
}
