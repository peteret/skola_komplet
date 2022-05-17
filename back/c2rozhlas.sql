-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost
-- Čas generovania: Út 17.Máj 2022, 12:47
-- Verzia serveru: 10.3.34-MariaDB-0+deb10u1
-- Verzia PHP: 7.3.33-1+0~20211119.91+debian10~1.gbp618351

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `c2rozhlas`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `actual_song`
--

CREATE TABLE `actual_song` (
  `actual_song_id` int(11) NOT NULL,
  `name_hour` varchar(255) NOT NULL,
  `hour_id` int(11) NOT NULL,
  `song_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `actual_song`
--

INSERT INTO `actual_song` (`actual_song_id`, `name_hour`, `hour_id`, `song_id`) VALUES
(1, 'Začiatok 1. hodiny', 999, 1),
(2, 'Koniec 1. hodiny', 1, 1),
(3, 'Začiatok 2. hodiny', 2, 1),
(4, 'Koniec 2. hodiny', 3, 1),
(5, 'Začiatok 3. hodiny', 4, 1),
(6, 'Koniec 3. hodiny', 5, 1),
(7, 'Začiatok 4. hodiny', 6, 1),
(8, 'Koniec 4. hodiny', 7, 1),
(9, 'Začiatok 5. hodiny', 8, 1),
(10, 'Koniec 5. hodiny', 9, 1),
(11, 'Začiatok 6. hodiny', 10, 1),
(12, 'Koniec 6. hodiny', 11, 1),
(13, 'Začiatok 7. hodiny', 12, 1),
(14, 'Koniec 7. hodiny', 13, 1),
(15, 'Začiatok 8. hodiny', 14, 1),
(16, 'Koniec 8. hodiny', 15, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `song`
--

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `song`
--

INSERT INTO `song` (`song_id`, `name`, `url`) VALUES
(1, 'Nič', '');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`user_id`, `nick`, `password`) VALUES
(1, 'admin', '$2y$10$AZRHn9l7aZfB1obBRGgDBu8BEH3u36D2jCMxzMuAwmPZ3B6eAuE8i');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `actual_song`
--
ALTER TABLE `actual_song`
  ADD PRIMARY KEY (`actual_song_id`),
  ADD KEY `song_id_2` (`song_id`);

--
-- Indexy pre tabuľku `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexy pre tabuľku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `actual_song`
--
ALTER TABLE `actual_song`
  MODIFY `actual_song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pre tabuľku `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `actual_song`
--
ALTER TABLE `actual_song`
  ADD CONSTRAINT `song_id` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
