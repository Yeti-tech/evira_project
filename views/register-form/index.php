<?php

use app\models\RegisterForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var RegisterForm $model */


if(Yii::$app->user->isGuest):
$form = ActiveForm::begin([
    'id' => 'login',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-form-label'],
        'inputOptions' => ['class' => 'form-control'],
        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
    ],
]); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <div class="offset-lg-1 col-lg-11">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>

<?php endif ?>
