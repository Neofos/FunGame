-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 10 2022 г., 11:09
-- Версия сервера: 5.7.35-38
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `neofos_fungame`
--
CREATE DATABASE IF NOT EXISTS `neofos_fungame` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `neofos_fungame`;

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`username`, `password`) VALUES
('AdminChad', '$2y$10$w689vltCFU6r2PYTSAOe.uXypslh2ygAVmp.6wGqsxu4gwiWlvOyK');

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Product` int(11) NOT NULL,
  `Percent` int(11) NOT NULL,
  `NewPrice` double NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Product` (`Product`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `discounts`
--

INSERT INTO `discounts` (`ID`, `Product`, `Percent`, `NewPrice`) VALUES
(1, 4, 20, 3999),
(2, 5, 10, 899),
(3, 6, 10, 3499),
(4, 7, 15, 4599);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` text NOT NULL,
  `IMGPreview` text NOT NULL,
  `IMGBanner` text NOT NULL,
  `Price` double NOT NULL,
  `Description` text NOT NULL,
  `Platform` text NOT NULL,
  `AgeRating` text NOT NULL,
  `IsHit` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`ID`, `Title`, `IMGPreview`, `IMGBanner`, `Price`, `Description`, `Platform`, `AgeRating`, `IsHit`) VALUES
(1, 'Super Mario Odyssey', 'super-mario-odyssey-box-switch.jpg', 'super-mario-odyssey-banner.png', 4999, 'Отправляйтесь с Марио в масштабное 3D-приключение и используйте его новые способности, чтобы помешать Боузеру, который задумал жениться на принцессе Пич!', 'Nintendo Switch', '6+', 1),
(2, 'BattleField 2042', 'battlefield2042-box-pc.jpg', 'battlefield2042-banner.jpg', 3499, 'Battlefield™ 2042 — это шутер от первого лица, в котором серия возвращается к легендарным масштабным сражениям. В недалёком будущем мир охватил хаос. Адаптируйтесь и преодолевайте трудности на постоянно меняющихся полях боя при поддержке своего отряда и с помощью передовых технологий вооружения.', 'Steam', '17+', 1),
(3, 'A Hat in Time', 'a-hat-in-time-box-pc.jpg', 'a-hat-in-time-banner.jpg', 499, 'A Hat in Time отправит вас в увлекательное путешествие через огромную вселенную, для того, чтобы спаси этот мир. Но сделать это совсем не просто! На вашем пути то и дело будут попадаться различные преграды.', 'Steam', '13+', 1),
(4, 'Elden Ring', 'elden-ring-box-pc.jpeg', 'banner-placeholder.jpg', 4999, 'Новый фэнтезийный ролевой боевик. Восстань, погасшая душа! Междуземье ждёт своего повелителя. Пусть благодать приведёт тебя к Кольцу Элден.', 'Epic Games Store', '16+', 0),
(5, 'Fallout 4', 'fallout-4-box-pc.jpg', 'banner-placeholder.jpg', 999, 'Новая, более усовершенствованная часть легендарной игры, которая снова окунет тебя в опасный мир, который пережил самый настоящий апокалипсис. Ты станешь одним из немногих выживших после ожесточенных военных действий.', 'PlayStation', '17+', 0),
(6, 'Animal Crossing: New Horizons', 'animal-crossing-box-switch.jpg', 'banner-placeholder.jpg', 3889, 'Animal Crossing: New Horizons помогает воплотить в жизнь мечты эскаписта, уставшего от царства стекла и бетона. Новая часть популярного симулятора жизни создан специально для гибридной консоли Nintendo Switch, позволяя перенестись в другую реальность в долгой дороге или после трудного дня, расслабившись перед телевизором', 'Nintendo Switch', '0+', 0),
(7, 'Assasin\'s Creed: Valhalla', 'ac-valhalla-box-xbox.jpg', 'banner-placeholder.jpg', 5399, 'В Assassin\'s Creed Вальгалла вам предстоит пройти путь к славе, играя за легендарного викинга по имени Эйвор. Исследуйте мир, сражайтесь, развивайте селение и усиливайте влияние. – Совершайте набеги на крепости саксов. – Сражайтесь двумя видами оружия одновременно. – Испытайте себя в битвах против самых разных противников. – С каждым выбором определяйте путь развития персонажа и селения клана. – Исследуйте открытый мир от берегов Норвегии до королевств Англии.', 'Xbox', '18+', 0),
(8, 'God of War', 'god-of-war-box-pc.jpg', 'banner-placeholder.jpg', 3389, 'Отомстив богам Олимпа, Кратос поселился в царстве скандинавских божеств и чудовищ. В этом суровом беспощадном мире он должен не только самостоятельно бороться за выживание... но и научить этому сына.', 'PlayStation', '18+', 0),
(9, 'Forza Horizon 4', 'forza-horizon-4-xbox-box.jpg', 'banner-placeholder.jpg', 1499, 'Forza Horizon 4 — продолжение популярного гоночного автосимулятора с видом от первого и третьего лица. Основа игры та же, что и раньше: гонки в открытом мире с большим упором на мультиплеер.', 'Xbox', '0+', 0),
(10, 'Hollow Knight: Silksong', 'hk-silksong-box-pc.jpg', 'banner-placeholder.jpg', 1999, 'Сие творение никогда не выйдет в свет... Но я все равно это продам. Остроумно, а?', 'Epic Games Store', '6+', 0);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`Product`) REFERENCES `products` (`ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
