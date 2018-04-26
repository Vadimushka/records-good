<?php
function getQuery(){
    $query = [];
    $query[] = "CREATE TABLE IF NOT EXISTS `list_products` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идетификатор',
  `storehouse_id` int(11) UNSIGNED NOT NULL COMMENT 'Идетификатор склада',
  `name` varchar(32) NOT NULL COMMENT 'Наименование',
  `price` int(10) UNSIGNED NOT NULL COMMENT 'Цена (руб.)',
  `amount` smallint(4) UNSIGNED NOT NULL COMMENT 'Количесво товара',
  `id_goods` int(11) UNSIGNED NOT NULL COMMENT 'Идетификатор товара',
  PRIMARY KEY (`id`),
  KEY `storehouse_id` (`storehouse_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список товаров';";

    $query[] = "CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идетификатор',
  `list_products_id` int(11) UNSIGNED NOT NULL COMMENT 'Идетификатор товара',
  `users_id` int(11) UNSIGNED NOT NULL COMMENT 'Идетификатор пользователя',
  PRIMARY KEY (`id`),
  KEY `list_products_id` (`list_products_id`) USING BTREE,
  KEY `users_id` (`users_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список заказов';";

    $query[] = "CREATE TABLE IF NOT EXISTS `storehouse` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT 'Наименование склада',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Склады';
INSERT INTO `storehouse` (`name`) VALUES ('Архив');";

    $query[] = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор',
  `group` smallint(1) NOT NULL DEFAULT '1' COMMENT 'Группа. Определяет уровень доступа',
  `login` varchar(32) NOT NULL COMMENT 'Логин',
  `password` varchar(32) NOT NULL COMMENT 'Хэш пароля',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';";

    $query[] = "ALTER TABLE `list_products`
  ADD CONSTRAINT `list_products_ibfk_1` FOREIGN KEY (`storehouse_id`) REFERENCES `storehouse` (`id`);
  ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`list_products_id`) REFERENCES `list_products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;";
    return $query;
}

include_once "sys/inc/initialization.php";

if ($_POST['submit']) {
    $host = $_POST['host'];
    $user = $_POST['user'];
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : "";
    $dbname = $_POST['dbname'];

    $file = 'sys/inc/settings.ini';
    $ini = [];
    $ini[] = "; saved by install.php";
    $ini[] = 'mysql_host = "' . $host . '"';
    $ini[] = 'mysql_user = "' . $user . '"';
    $ini[] = 'mysql_pass = "' . $pass . '"';
    $ini[] = 'mysql_dbname = "' . $dbname . '"';
    file_put_contents($file, implode("\r\n", $ini));

    $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
    foreach (getQuery() as $q) {
        $db->query($q);
    }
    $res = $db->prepare("INSERT INTO `users` (`group`, `login`, `password`) VALUES (?, ?, ?)");
    $res->execute(Array($_POST['group'], $_POST['login'], pass_hash($_POST['password'])));

    header("Location: /index.php");
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="На этом сайте вы можете вести учет товаров для строительного склада.."/>
    <title>Установка системы "CMS Склад..."</title>
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/justifed-nav.css">
</head>
<body>
<div class="container">
    <header class="masthead"><h3 class="text-muted">CMS Склад - Установка</h3></header>

    <main role="main">

        <!-- Jumbotron -->
        <div class="jumbotron"><h1>Установка</h1></div>

        <!-- Example row of columns -->
        <form method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Подключение к базе данных</label>
                    </div>
                    <div class="form-group">
                        <label for="host">Сервер MySQL</label>
                        <input type="text" class="form-control" name="host" id="host" placeholder="Сервер MySQL">
                    </div>
                    <div class="form-group">
                        <label for="user">Пользователь</label>
                        <input type="text" class="form-control" name="user" id="user" placeholder="Пользователь">
                    </div>
                    <div class="form-group">
                        <label for="pass">Пароль аккаунта</label>
                        <input type="text" class="form-control" name="pass" id="pass" placeholder="Пароль аккаунта">
                    </div>
                    <div class="form-group">
                        <label for="dbname">База данных</label>
                        <input type="text" class="form-control" name="dbname" id="dbname" placeholder="База данных">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Создание админа</label>
                    </div>
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Логин" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Пароль"
                               required>
                    </div>
                    <input type="hidden" name="group" value="1">
                </div>
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary" name="submit" value="Завершить установку"/>
                </div>
            </div>
        </form>
    </main>

    <!-- Site footer -->
    <footer class="footer"><p>© 2017 vadimushka_d</p></footer>
</div>
</body>
</html>