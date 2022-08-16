<?php

use app\models\RegisterForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\VarDumper;

/** @var RegisterForm $model */

?>
<div class=registration-content>
    <span><b><br>Регистрация</b></span>
    <div class=line></div>
    <?php
    if (Yii::$app->user->isGuest):

        $form = ActiveForm::begin([
            'id' => 'register',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}",
                'labelOptions' => ['class' => 'col-form-label'],
                'inputOptions' => ['class' => 'form-control'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-default', 'name' => 'register-button', 'id' => 'register-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif ?>

</div>

<link rel="stylesheet" href="../../stylesheets/page.css">
