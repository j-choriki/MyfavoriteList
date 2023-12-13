-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2023 年 12 月 13 日 06:55
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `favorite_restrant`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite_list`
--

CREATE TABLE `favorite_list` (
  `id` int(11) NOT NULL,
  `restrant_id` varchar(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favorite_list`
--

INSERT INTO `favorite_list` (`id`, `restrant_id`, `member_id`) VALUES
(27, 'J000507673', 3),
(32, 'J000829404', 5),
(33, 'J000838998', 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`id`, `mail`, `pass`) VALUES
(5, 'aaa@gmail.com', '$2y$10$5Hpz6t9wQ0IyyuGh1PAUmutD5ZrZjsddur/KkhpumBSuPjGFbY2Ti'),
(6, 'jj@example.com', 'jjjjjjjj');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `favorite_list`
--
ALTER TABLE `favorite_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `favorite_list`
--
ALTER TABLE `favorite_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- テーブルの AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
