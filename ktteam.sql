-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 13 2019 г., 20:11
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ktteam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `Text` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `Text`) VALUES
(1, 'Новая'),
(2, 'В работе'),
(3, 'Завершена'),
(4, 'Приостановлено');

-- --------------------------------------------------------

--
-- Структура таблицы `tasklist`
--

CREATE TABLE `tasklist` (
  `Id` int(11) NOT NULL,
  `Text` varchar(255) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasklist`
--

INSERT INTO `tasklist` (`Id`, `Text`, `IdUser`, `Status`, `Created`) VALUES
(3, 'Настройка оборудования для синхронного перевода', 3, 3, '2019-11-13 19:32:30'),
(7, 'Организовать доставку вице-президента на корпоративное мероприятие', 32, 1, '2019-11-07 10:24:04'),
(8, 'Настроить режимы ', 31, 1, '2019-11-13 10:26:10'),
(10, 'Подготовить презентацию компании', 2, 2, '2019-11-13 19:52:13'),
(11, 'Подготовить партию продукции к дегустации', 25, 1, '2019-11-13 10:29:26');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Iname` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Post` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `Iname`, `Fname`, `Post`, `Department`) VALUES
(2, 'Джефри', 'Раш', 'Менеджер', 'Отдел метериально-технического обеспечения'),
(3, 'Натали', 'Портман', 'Начальник отдела', 'ИТ'),
(23, 'Бредли', 'Купер', 'Менеджер', 'Логистики'),
(24, 'Джон', 'Малкович', 'Менеджер', 'Логистики'),
(25, 'Лив', 'Тейлор', 'Старший лаборант', 'Лаборатория'),
(31, 'Николас', 'Кейдж', 'Ведущий специалист по видеонаблюдению', 'Безопасности'),
(32, 'Джейсон', 'Стейтем', 'Начальник группы сопровождения грузов', 'Безопасности');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasklist`
--
ALTER TABLE `tasklist`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `tasklist`
--
ALTER TABLE `tasklist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
