<?php

$query = array();
$query[] = "CREATE TABLE IF NOT EXISTS `list_products` (
`id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идетификатор',
`id_storehouse` int(10) NOT NULL DEFAULT '0' COMMENT 'Идетификатор склада',
`name` varchar(32) NOT NULL DEFAULT '0' COMMENT 'Наименование',
`price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Цена (руб.)',
`amount` smallint(4) unsigned NOT NULL COMMENT 'Количесво товара',
`id_goods` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Идетификатор товара',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список товаров';";

$query[] = "CREATE TABLE IF NOT EXISTS `storehouse` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT 'Наименование склада',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Склады';";

$query[] = "INSERT INTO `storehouse` (`name`) VALUES ('Архив');";

$query[] = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор',
  `group` smallint(1) NOT NULL DEFAULT '1' COMMENT 'Группа. Определяет уровень доступа',
  `login` varchar(32) NOT NULL COMMENT 'Логин',
  `password` varchar(32) NOT NULL COMMENT 'Хэш пароля',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';";