-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2020. Ápr 18. 16:36
-- Kiszolgáló verziója: 10.1.38-MariaDB
-- PHP verzió: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `franchise`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(500) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(500) CHARACTER SET latin1 NOT NULL,
  `address` varchar(900) COLLATE utf8_hungarian_ci NOT NULL,
  `lng` float NOT NULL,
  `lat` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `posts`
--

INSERT INTO `posts` (`id`, `name`, `email`, `phone`, `address`, `lng`, `lat`, `created_at`) VALUES
(26, 'Vedox', 'info@vedox.hu', '3617008860', 'Magyarország 2900 Komárom Sport utca 28/a', 47.7465, 18.1236, '2020-04-18 16:24:38'),
(28, 'Grandis Kft.', 'grandis@email.hu', '36308481420', 'Magyarország 8200 Veszprém Pillér utca 15', 47.1049, 17.8843, '2020-04-18 16:28:25'),
(29, 'Kingstore Magyarország Kft.', 'king@email.hu', '36308481420', 'Magyarország 4400 Nyíregyháza Tiszavasvári út 21', 47.9573, 21.6925, '2020-04-18 16:29:44');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
