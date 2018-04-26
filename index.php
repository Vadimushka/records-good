<?php
include_once 'sys/inc/start.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="На этом сайте вы можете вести учет товаров для строительного склада.."/>
    <title>Учёт товаров на строительном складе.</title>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <link type="text/css" rel="stylesheet" href="css/modal.css"/>
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
</head>
<body>

<? include_once "sys/tpl/header.php"; ?>

<section class="row">
    <div class="grid">
        <section class="col-2-3">
            <h2>Описание сервиса</h2>

            <p>На данном сайте вы сможете произвести такие операции как: </p>
            <ul class="why-attend">
                <li>Добавить товар на склад.</li>
                <li>Изменить либо архивировать товар.</li>
                <li>Удалить товар можно только архивированный</li>
            </ul>
            <br>
            <ul class="why-attend">
                <li>
                    <small style="color:red">*</small>
                    - Все что выше с учетом авторизованного входа.
                </li>
                <li>Для гостя доступен только просмотр, сортировка товаров.</li><?php if (!$_SESSION['admin']) { ?>
                    <li>Справа форма для входа.</li><?php } ?></ul>
        </section><!--
		
        --><section class="col-1-3">
            <?php if (!$_SESSION['admin']){ ?>
                <form method="post" action="login.php">
                    <fieldset class="register-group">
                        <label>Логин: <input type="text" name="login" id="login" placeholder="Логин" required></label>
                        <label>Пароль <input type="password" name="password" id="password" placeholder="Пароль"
                                             required></label>
                    </fieldset>

                    <input class="btn btn-default" style="text-transform: none" type="submit" name="submit" value="Войти"/>
                    <input class="btn btn-alt" style="text-transform: none;" type="reset" name="reset" value="Сбросить">
                </form>
                <?php
            } else { ?>
            <div><?php if ($_SESSION['group'] == 2): ?>
                    <div><i class="fa fa-sun-o" aria-hidden="true"></i> Панель директора:</div>
                    <div><i class="fa fa-user-plus" aria-hidden="true"></i><label title="Создать модераторов" class="links user_info" for="modal-create_user">Cоздать модераторов</label></div>
                    <div><i class="fa fa-user-times" aria-hidden="true"></i><label title="Удалить модераторов" class="links user_info" for="modal-delete_user"> Удалить модераторов</label></div>
                    <hr>
                <? endif; ?>

                <div><i class="fa fa-user-circle" aria-hidden="true"></i> Панель пользователя:</div>
                <div><i class="fa fa-user fa-lg" aria-hidden="true"></i><span class="user_info">Логин: <?php echo $_SESSION['admin']; ?></span></div>
                <dvi><i class="fa fa-users" aria-hidden="true"></i><span class="user_info">Дожность: <? if ($_SESSION['group'] == 2): ?>Директор склада<? else: ?>Модератор склада<? endif; ?></span>
            </div>
            <div><i class="fa fa-power-off" aria-hidden="true"></i> <a href="logout.php">Выход</a></div>
    </div>
    <?php } ?>
</section>

<? include_once "sys/tpl/footer.php"; ?>
<? include_once "sys/tpl/index-modal.php"; ?>
</body>
</html>