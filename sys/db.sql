-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.1.73-community-log - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных records
CREATE DATABASE IF NOT EXISTS `records` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `records`;

-- Дамп структуры для таблица records.list_products
CREATE TABLE IF NOT EXISTS `list_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идетификатор',
  `id_storehouse` int(10) NOT NULL DEFAULT '0' COMMENT 'Идетификатор склада',
  `name` varchar(32) NOT NULL DEFAULT '0' COMMENT 'Наименование',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Цена (руб.)',
  `amount` smallint(4) unsigned NOT NULL COMMENT 'Количесво товара',
  `id_goods` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Идетификатор товара',
  PRIMARY KEY (`id`),
  KEY `id_storehouse` (`id_storehouse`),
  CONSTRAINT `id_storehouse` FOREIGN KEY (`id_storehouse`) REFERENCES `storehouse` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Список товаров';

-- Дамп данных таблицы records.list_products: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `list_products` DISABLE KEYS */;
INSERT INTO `list_products` (`id`, `id_storehouse`, `name`, `price`, `amount`, `id_goods`) VALUES
	(8, 7, 'Электродрель', 4500, 5, 0),
	(9, 7, 'Молоток', 150, 50, 0),
	(10, 7, 'Кирдык', 23, 34, 0),
	(11, 7, 'Перфоратор', 4300, 3, 23522),
	(12, 7, 'Перфоратор', 3456, 3242, 3533);
/*!40000 ALTER TABLE `list_products` ENABLE KEYS */;

-- Дамп структуры для таблица records.storehouse
CREATE TABLE IF NOT EXISTS `storehouse` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT 'Наименование склада',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Склады';

-- Дамп данных таблицы records.storehouse: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `storehouse` DISABLE KEYS */;
INSERT INTO `storehouse` (`id`, `name`) VALUES
	(0, 'Архив'),
	(7, 'Электроприборы'),
	(8, 'Ударные');
/*!40000 ALTER TABLE `storehouse` ENABLE KEYS */;

-- Дамп структуры для таблица records.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор',
  `group` smallint(1) NOT NULL DEFAULT '1' COMMENT 'Группа. Определяет уровень доступа',
  `login` varchar(32) NOT NULL COMMENT 'Логин',
  `password` varchar(32) NOT NULL COMMENT 'Хэш пароля',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';

-- Дамп данных таблицы records.users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `group`, `login`, `password`) VALUES
	(1, 2, 'admin', '279bdf5db613cde6b8678a0b82decfc8'),
	(2, 1, 'test', '46c6a31f7670274b1d0517adcac20e9a');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
