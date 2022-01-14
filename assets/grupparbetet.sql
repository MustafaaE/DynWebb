-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 14 jan 2022 kl 19:07
-- Serverversion: 5.7.24
-- PHP-version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `grupparbete`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `isVisible` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `user_id`, `post_id`, `created_time`, `isVisible`) VALUES
(1, 'Please dont hack me bro :(', 5, 11, '2022-01-12 18:12:11', 1),
(2, 'damn he ugly', 7, 16, '2022-01-12 18:20:03', 0),
(3, 'cool pic!', 7, 24, '2022-01-12 18:20:21', 1),
(4, 'get rid of him', 8, 16, '2022-01-12 18:21:47', 0),
(5, 'DONT TALK SHIT ABOUT MY DOG', 5, 16, '2022-01-12 18:24:52', 1),
(6, 'hi', 8, 30, '2022-01-12 19:05:08', 0),
(7, 'hi', 9, 33, '2022-01-13 10:12:01', 0),
(8, 'i think he\'s cute', 9, 16, '2022-01-13 10:13:02', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `following`
--

CREATE TABLE `following` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `following`
--

INSERT INTO `following` (`follow_id`, `user_id`, `follower_id`) VALUES
(76, 5, 6),
(77, 5, 7),
(78, 6, 7),
(79, 4, 8),
(80, 5, 8),
(81, 6, 8),
(83, 7, 5),
(84, 6, 5),
(85, 5, 9),
(86, 6, 9),
(87, 4, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_file` varchar(255) DEFAULT NULL,
  `created_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`post_id`, `description`, `image_file`, `created_time`, `user_id`) VALUES
(1, ' test id:1', '/DynWebb/uploads/coffee-love-foam-with-beans-cartoon-icon-illustration_138676-2575.jpg', '2022-01-08 13:45:52', 1),
(7, ' I&#39;m gonna hack you, boy.', '/anonymous.jpg', '2022-01-12 18:05:09', 4),
(8, ' ', '/anime-gurl.png', '2022-01-12 18:08:41', 4),
(9, ' ', '/clock.png', '2022-01-12 18:08:47', 4),
(10, ' ', '/bloodborne.png', '2022-01-12 18:08:53', 4),
(11, ' ', '/stock-photo-hacking.jpg', '2022-01-12 18:08:59', 4),
(12, ' ', '/testbild.jpg', '2022-01-12 18:09:03', 4),
(13, ' i LOVE you ', '/beck.png', '2022-01-12 18:10:49', 5),
(14, ' i love u 2 ', '/cool-looking-guy.png', '2022-01-12 18:11:15', 5),
(15, ' i LOVE drama ', '/drama.png', '2022-01-12 18:11:33', 5),
(16, ' aint my dog cute?  ', '/not-so-cute-doggo.png', '2022-01-12 18:11:48', 5),
(17, ' Hated this game, would not recommend!', '/big-nightmares.png', '2022-01-12 18:13:27', 6),
(18, ' could not even kill the first boss, never again !', '/bloodborne.png', '2022-01-12 18:13:58', 6),
(19, ' They should add a very easy mode', '/pirates.png', '2022-01-12 18:15:00', 6),
(20, ' Trading went good today! :D', '/stocks.png', '2022-01-12 18:15:23', 6),
(21, ' ANIME SUCKS !!! - Armin', '/no-life-much-game.png', '2022-01-12 18:15:52', 6),
(22, ' All my homies hate Wordpress', '/joshua.jpg', '2022-01-12 18:16:04', 6),
(23, ' memes', '/fabolous.png', '2022-01-12 18:16:17', 6),
(24, ' Never really liked this game', '/tova1.png', '2022-01-12 18:16:41', 6),
(25, ' Love this job', '/bork.jpg', '2022-01-12 18:19:26', 7),
(26, ' Got a new clock', '/clock.png', '2022-01-12 18:15:37', 7),
(27, ' what even is this?', '/toottaaruuu.png', '2022-01-12 18:19:48', 7),
(28, ' crazy', '/testbild.jpg', '2022-01-12 18:22:11', 8),
(29, ' wow', '/alien-pyramids-wqhd-1440p-wallpaper.jpg', '2022-01-12 18:16:33', 8),
(30, ' cool game, never played', '/assasins-creed.png', '2022-01-12 18:22:57', 8),
(31, ' i&#39;m a hacker boii', '/hackerpic2.jpg', '2022-01-12 19:07:14', 8),
(32, ' ', '/i-love-wcm.jpg', '2022-01-13 10:11:12', 9),
(33, ' fin bild', '/art.png', '2022-01-13 10:11:46', 9);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'test', '$2y$10$vxUCcUTuxHuRmI3BhHnedOWhQniE0FWgChRIDuxPL6mKk560nGleO', 'test@ex.com'),
(4, 'hacker', '$2y$10$eEIwvEn08fHlmtHrD4d7f.cMk0uO8MITwE4Ox/3OG3I4sTEW5JnSS', 'hacker@hotmail.se'),
(5, 'Armin', '$2y$10$AUpRC.WE0ytQGvWKmnoDCuJo4hudNbTGODK0mj1ZVDDPvuMBt98P6', 'Armin@hotmail.se'),
(6, 'Tova', '$2y$10$wspIOVdwZvdCKJ5.nek0G.N3Oqx.rMmNOa6z47EJ0.8e5FAdojG0K', 'tova@hotmail.se'),
(7, 'Carl', '$2y$10$9wDEJm1oyKis/1qF5u9ViuJP7coRvWiPFpI1ysz9REWUIyNpQkxnu', 'carl@hotmail.se'),
(8, 'Mustafa', '$2y$10$MCUklHg8AlgUJy6uyilrUukEbByXs7aVbpiTONt6DFH6iG7RlKdZS', 'mustafa@hotmail.se'),
(9, 'Mikko', '$2y$10$WzV1Ai3ebQBPNViMGL.MxuDvhX9lo9OHIrcKGa9YHexAoNYosGt/m', 'Mikko@hotmail.se');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index för tabell `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Index för tabell `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT för tabell `following`
--
ALTER TABLE `following`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT för tabell `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Restriktioner för tabell `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `following_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `following_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`);

--
-- Restriktioner för tabell `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Restriktioner för tabell `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
