-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 05 2018 г., 16:57
-- Версия сервера: 5.7.19
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `practice_discounts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `conditions`
--

CREATE TABLE `conditions` (
  `id` int(5) NOT NULL,
  `id_services` varchar(200) NOT NULL,
  `phone` tinyint(1) NOT NULL,
  `number_phone` int(200) DEFAULT NULL,
  `gender` varchar(11) NOT NULL,
  `b_date` varchar(21) NOT NULL,
  `discount` int(3) NOT NULL DEFAULT '0',
  `period_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `conditions`
--

INSERT INTO `conditions` (`id`, `id_services`, `phone`, `number_phone`, `gender`, `b_date`, `discount`, `period_active`) VALUES
(1, '[1,2]', 0, 8935, 'mail', '0', 25, '2018-12-07'),
(2, '[1,2]', 0, 8935, 'mail', '0', 31, '2018-12-07'),
(12, '1', 1, 1415, 'mail', '0', 0, '2019-03-15'),
(13, '\"1,2,3\"', 36, 1495, 'mail', '0', 0, '2019-03-15'),
(14, '[1,2,5]', 45, 6597, 'mail', '0', 0, '2019-03-15'),
(15, '[1,5,6]', 1, 1236, 'mail', '0', 36, '2018-12-15');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`) VALUES
(1, 'Мойка ковров'),
(2, 'Уборка квартиры'),
(3, 'Влажная уборка'),
(4, 'Сухая уборка'),
(5, 'Вынести мусор'),
(6, 'Протереть пыль'),
(7, '3арядка устройств');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
