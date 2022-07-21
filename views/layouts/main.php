<?php

/** @var yii\web\View $this */
/** @var string $content */


use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Button;use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<style>
    html { overflow:  hidden; }
    body::before {
        content: '';
        position: fixed;
        left: 0; right: 0;
        top: 0; bottom: 0;
        z-index: -1;
        background: url('/web/images/honeyy.jpg') center / cover no-repeat;
        filter: opacity(65%);
    }
.register_form {
    z-index: 5;
    background-color:#f7db5b;
    width: 290px;
}

.initial_form {
    position: absolute;
    bottom: 180px;
    right: 10px;
}
    /* Main Classes */

    .col-form-label {
        width: 400px;
        text-align: left;
    }

    .col-form-input {
        width: 200px;
    }

.medium{
    font-size: x-small;
    font-weight: normal;
}
    .myinput{
        position: relative;
        left: 100px;
        bottom: 35px;
        display: block;
        width: 30px;
        height: 40px;
        background: #FFF;
    }

    form {
        /* Just to center the form on the page */
        margin: 0 auto;
        width: 400px;

        /* To see the limits of the form */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
    }

    input {
        border: 1px solid #666; /* Параметры рамки */
    }
    input:focus {
        box-shadow: 0 0 5px 1px #00a8de; /* Свечение вокруг поля */
        background: #fffac0; /* Цвет фона */
    }

    div + div {
        margin-top: 1em;
    }

    label {
        /* To make sure that all label have the same size and are properly align */
        display: inline-block;
        width: 90px;
        text-align: right;
    }

    input, textarea {
        /* To make sure that all text field have the same font settings
           By default, textarea are set with a monospace font */
        font: 1em sans-serif;

        /* To give the same size to all text field */
        width: 300px;

        -moz-box-sizing: border-box;
        box-sizing: border-box;

        /* To harmonize the look & feel of text field border */
        border: 1px solid #999;
    }

    textarea {
        /* To properly align multiline text field with their label */
        vertical-align: top;

        /* To give enough room to type some text */
        height: 5em;

        /* To allow users to resize any textarea vertically
           It works only on Chrome, Firefox and Safari */
        resize: vertical;
    }

    .button {
        /* To position the buttons to the same position of the text fields */
        padding-left: 90px; /* same size as the label elements */
    }

    button {
        /* This extra margin represent the same space as the space between
           the labels and their text fields */
        margin-left: .5em;
    }
.errorMessage {
    position:absolute;;
    left: 30px;
    top: 310px;
    width: 230px;
    height: 35px;
    font-size: xx-small;
    text-align: left;
    color: darkred;
    background-color: #f7db5b;
    border: 3px solid gold;
    font-weight: bold;
}

 .button_css
{
display: inline-block;
background-color: gold;
color: black;
font-family: monospace;
font-size: xx-small;
position: absolute;
top: 10px;
right:10px;
width: 90px;
height: 45px;
font-weight: bold;
border: 3px solid gold;
}

    .deactivated
    {
        pointer-events: none;
    }

 .form
 {
     position: relative;
     top: 100px;
 }

 .smaller{
     font-size: xx-small;
     color: #5e260e;
     text-decoration: underline;

 }

 .username {
     color: indigo;
     position: absolute;
     right: 50px;
     top: 300px;
     text-decoration: underline;
     font-size: small;
 }
</style>


<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href= "../../web/css/jquery-msgpopup.css">
<script> <?php require(__DIR__.'/../../web/js/jquery-msgpopup.js')?> </script>

<?php $this->beginBody() ?>

<header>
    <?php
/**   NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Register', 'linkOptions' => ["alert('kk')"]],

            Yii::$app->user->isGuest ? (
               ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                   ['class' => 'btn btn-link logout']
               )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
 NavBar::end();
   */
    ?>


</header>

<main role="main" class="flex-shrink-0">

  <?php  if(Yii::$app->user->isGuest): ?>
    <button id = 'login' class = 'button_css'>Войти</button>
    <?php else: ?>
    <button id = 'logout' class = 'button_css'>Выйти</button>
    <?php endif ?>
    <noindex id = 'form' class = 'initial_form'></noindex>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>



<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script> <?php require(__DIR__.'/../../web/js/javaScript.js')?> </script>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href= "../../web/css/jquery-msgpopup.css">
<script> <?php require(__DIR__.'/../../web/js/jquery-msgpopup.js')?> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2"></script>



