<?php

use app\models\PasswordRestore;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var PasswordRestore $passwordRestore */
?>

<div class=inner-content-restore-password>
    <section class="content-section">
        <h1 class=big-text><br>Восстановление пароля</h1>
        <div class=line></div>
    </section>
    <div class="space-top"></div>
    <p class="alert alert-info"> Укажите электронную почту, к которой привязан ваш профиль. Мы вышлем письмо с ссылкой
        для входа на сайт</p>
    <div class="alert alert-warning" role="alert">
        <section class="content-section">
            <?php
            $form = ActiveForm::begin([
                'id' => 'password-restore',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}{input}",
                    'labelOptions' => ['class' => 'col-form-label black'],
                    'inputOptions' => ['class' => 'form-control'],
                ],
            ]); ?>

            <?= $form->field($passwordRestore, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div class="offset-lg-1 col-lg-11">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-default', 'name' => 'restore-password-button', 'id' => 'restore-password-button']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </section>
    </div>


    <link rel="stylesheet" href="../../stylesheets/page.css">

