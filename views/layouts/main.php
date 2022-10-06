<?php

/* @var $this \yii\web\View */
/* @var $content string */


// <meta name="viewport" content='content="width=device-width, initial-scale=1.0'>
use app\assets\AppAsset;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

?>

<link rel="stylesheet" href="../../stylesheets/page.css">

<?php
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <?php $this->head() ?>
    <link rel="icon" href="data:;base64,=">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>

<?php $this->beginBody() ?>

<?php
/**  echo Nav::widget([
 * 'options' => ['class' => 'navbar-nav'],
 * 'items' => [
 * ['label' => 'Home', 'url' => ['/site/index']],
 * ['label' => 'About', 'url' => ['/site/about']],
 * ['label' => 'Contact', 'url' => ['/site/contact']],
 * Yii::$app->user->isGuest ? (
 * ['label' => 'Login', 'url' => ['/site/login']]
 * ) : (
 * '<li>'
 * . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
 * . Html::submitButton(
 * 'Logout (' . Yii::$app->user->identity->username . ')',
 * ['class' => 'btn btn-link logout']
 * )
 * . Html::endForm()
 * . '</li>'
 * )
 * ],
 * ]);
 * NavBar::end();
 */
?>
<div class="main-site-container">
    <div class="site-container">
        <div class="header-t">
            <nav class="add-nav pull-right hidden-xs top-nav">
                <a href="/faq" style="color: wheat;">FAQ</a>
                <a href="/rules" style="color: wheat;"> ПРАВИЛА</a>
            </nav>
            <noindex>
                <ul class="useractivities list-inline d-flex align-items-center" id='useractivities'>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="dropdown open" id="login">
                            <a href="/login#jsLogin" rel="nofollow" class="dropdown dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="true" id = 'dropdown'>
                                <span>Вход</span>
                            </a>
                            <ul class="login-dropdown dropdown-menu dropdown-menu-right js-keep-open">
                                <form method="post" id="mainLoginForm">
                                    <div class="form-group">
                                        <label for="loginForLoginForm">Имя пользователя</label>
                                        <input id="loginForLoginForm" name="username" type="text" class="form-control"
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordForLoginForm">Пароль</label>
                                        <input id="passwordForLoginForm" name="password" type="password"
                                               class="form-control" autocomplete="off">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="rememberMe" type="checkbox" value="on" checked> запомнить
                                        </label>
                                    </div>
                                    <input type="submit" value="Войти" name="do_login" id="do_login"
                                           class="btn btn-default">
                                    <div class="clearfix">
                                        <a href="http://evira/web/password-restore" rel="nofollow" class="pull-right clearfix"
                                           style="font-size: 10px;">
                                        </a>
                                    </div>
                                </form>
                                <div class="login-error-msg" id="loginErrorMsg"></div>
                                <div class="block-separator my-15">
                                </div>
                                <div class="small-text text-center sign-up-text"> У вас нет аккаунта?
                                    <a href="http://evira/web/register-form" rel="nofollow"
                                       class="btn btn-default btn-small sign-up-button"> Зарегистрироваться
                                    </a>
                                </div>
                            </ul>
                        </li>
                    <?php else :
                    echo '<div class = "white">' . User::findUsername(Yii::$app->user->id) . '</div>';
                    endif ?>
                </ul>
            </noindex>
        </div>
        <div class=main_content>
            <?php Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?php Alert::widget() ?>
            <?= $content ?>

        </div>
    </div>
</div>
<?php
/**
 * <footer class="footer mt-auto py-3 text-muted">
 * <div class="container">
 * <p class="float-left">&copy; My Company <?= date('Y') ?></p>
 * <p class="float-right"><?= Yii::powered() ?></p>
 * </div>
 * </footer>
 */
?>
<?php $this->endBody() ?>

<?php $this->endPage() ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> <?php require(__DIR__ . '/../../web/js/javaScript.js')?> </script>
<script> <?php require(__DIR__ . '/../../web/js/jquery-msgpopup.js')?> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="../../web/css/jquery-msgpopup.css">
<link rel="stylesheet" href="../../stylesheets/page.css">
