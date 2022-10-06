<?php

use app\models\User;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var User $user */
/** @var integer $token*/

?>
<div class=inner-content-restore-password>
    <section class="content-section">
        <h1 class=big-text><br>Восстановление пароля</h1>
        <div class=line></div>
    </section>
    <div class="space-top"></div>
    <p class="alert alert-info"> Введите новый пароль для входа на сайт</p>
    <div class="alert alert-warning" role="alert">
        <section class="content-section">
            <?php
            $form = ActiveForm::begin([
                'id' => 'password-reset',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}{input}",
                    'labelOptions' => ['class' => 'col-form-label black'],
                    'inputOptions' => ['class' => 'form-control'],
                ],
            ]); ?>
            <?= $form->field($user, 'password')->passwordInput(['autofocus' => true]) ?>
            <?=$form->field($user, 'access_token')->hiddenInput(['value' => $token])->label(false) ?>
            <div class="form-group">
                <div class="offset-lg-1 col-lg-11">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-default', 'name' => 'reset-password-button', 'id' => 'reset-password-button']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </section>
    </div>


    <link rel="stylesheet" href="../../stylesheets/page.css">

