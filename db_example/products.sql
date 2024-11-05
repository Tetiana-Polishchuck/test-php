-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Час створення: Лис 05 2024 р., 10:59
-- Версія сервера: 8.0.40
-- Версія PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `test_database`
--

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` int NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Миша Logitech G102', 5, 10, 1400, '2024-11-05 10:06:28', '2024-11-05 10:06:28'),
(2, 'Миша Razer DeathAdder', 5, 15, 1300, '2024-11-05 10:07:02', '2024-11-05 10:07:02'),
(3, 'Миша Bloody J90s', 5, 23, 1000, '2024-11-05 10:07:48', '2024-11-05 10:07:48'),
(4, 'Миша Миша A4Tech V9MA ', 5, 3, 1100, '2024-11-05 10:08:22', '2024-11-05 10:08:22'),
(5, 'Навушники Samsung Galaxy Buds', 1, 56, 7000, '2024-11-05 10:17:45', '2024-11-05 10:17:45'),
(6, 'Навушники Nokia Go Earbuds', 1, 6, 1600, '2024-11-05 10:19:37', '2024-11-05 10:19:37'),
(7, 'Навушники Anker SoundCore P40i TWS', 1, 10, 3500, '2024-11-05 10:20:32', '2024-11-05 10:20:32'),
(8, 'Samsung Battery Pack 20000', 4, 4, 2500, '2024-11-05 10:21:42', '2024-11-05 10:21:42'),
(9, 'Зарядна станція Bluetti PowerOak ', 4, 1, 45000, '2024-11-05 10:22:29', '2024-11-05 10:22:29'),
(10, 'Зарядна станція EcoFlow RIVER 2', 4, 34, 25000, '2024-11-05 10:23:05', '2024-11-05 10:23:05'),
(11, 'Фотокамера Canon EOS R6 Mark II', 3, 23, 110000, '2024-11-05 10:23:59', '2024-11-05 10:23:59'),
(12, 'Фотоапарат Canon EOS 4000D', 3, 3, 13000, '2024-11-05 10:24:54', '2024-11-05 10:24:54'),
(13, 'Камера моментального друку Polaroid Now Gen 2', 3, 67, 6000, '2024-11-05 10:25:40', '2024-11-05 10:25:40'),
(14, 'Фітнес-браслет Samsung Galaxy Fit3 Rose', 2, 5, 2300, '2024-11-05 10:26:41', '2024-11-05 10:26:41'),
(15, 'Фітнес-браслет годинник Xiaomi Smart Band 7 Pro', 2, 56, 3550, '2024-11-05 10:27:21', '2024-11-05 10:27:21');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `price` (`price`),
  ADD KEY `created_at` (`created_at`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
