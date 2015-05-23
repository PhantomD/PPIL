-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 23 Mai 2015 à 16:54
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ppil`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaries`
--

CREATE TABLE IF NOT EXISTS `commentaries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `commentaries`
--

INSERT INTO `commentaries` (`ID`, `text`, `task_id`, `user_id`) VALUES
(1, 'test', 6, 67),
(2, 'coucou', 9, 67),
(3, 'gg', 9, 67),
(4, 'vdv ', 9, 67),
(5, 'vdv ', 9, 67),
(6, 'bvfkf ', 9, 67),
(7, 'bvfkf ', 9, 67),
(8, 'bvfkf ', 9, 67),
(9, 'r', 9, 67),
(10, 'c', 9, 67),
(11, 'c', 9, 67),
(12, 'o', 9, 67),
(13, 'k', 9, 67),
(14, 'k', 9, 67),
(15, 'p', 9, 67),
(16, 'p', 9, 67),
(17, 'f', 8, 67),
(18, 'fv', 8, 67),
(19, 'fv', 8, 67),
(20, 'f', 8, 67),
(21, 'fff', 8, 67),
(22, 'fff', 8, 67),
(23, 's', 10, 67),
(24, 'dd', 10, 67),
(25, 'dd', 10, 67),
(26, 'd', 10, 67),
(27, 'ff', 10, 67),
(28, 'dd', 10, 67),
(29, 'dd', 10, 67),
(30, 'c', 11, 67),
(31, 'c', 11, 67),
(32, 'c', 11, 67),
(33, 's', 8, 67),
(34, 'f', 7, 50),
(35, 'ff', 7, 50),
(36, 'ff', 7, 50),
(37, 'd', 7, 50),
(38, 'fff', 7, 50),
(39, 'fff', 7, 50),
(40, 'd', 7, 50),
(41, 'dd', 7, 50),
(42, 'dd', 7, 50),
(43, 'e', 7, 50),
(44, 'err', 7, 50),
(45, 'fff', 7, 50),
(46, 'ss', 7, 50),
(47, 'qqqq', 7, 50);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `isReaded` tinyint(1) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `todolist_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `isReaded`, `sender_id`, `reciever_id`, `todolist_id`, `type`, `date`) VALUES
(1, '', 'On vous a ajoutÃ© dans la liste liste1', 1, 67, 50, 178, 0, '2015-05-19 18:37:14'),
(2, '', 'On vous a ajoutÃ© dans la liste liste1', 1, 67, 50, 178, 0, '2015-05-19 18:40:27'),
(3, '', 'On vous a ajoutÃ© dans la liste liste1', 0, 67, 54, 178, 0, '2015-05-19 18:41:44'),
(4, '', 'On vous a ajoutÃ© dans la liste liste1', 0, 67, 55, 178, 0, '2015-05-19 18:47:13'),
(5, '', 'On vous a surpprimÃ© de la liste liste1', 0, 67, 24, 178, 0, '2015-05-19 19:00:02'),
(6, '', 'On vous a ajoutÃ© dans la liste ma liste de merde', 0, 67, 54, 186, 0, '2015-05-20 12:48:11'),
(7, '', 'On vous a ajoutÃ© dans la liste ma liste de merde', 1, 67, 50, 186, 0, '2015-05-20 12:48:12'),
(8, '', 'On vous a ajoutÃ© dans la liste ma liste de merde', 0, 67, 55, 186, 0, '2015-05-20 12:48:13'),
(9, '', 'On vous a ajoutÃ© dans la liste ma liste de merde', 0, 67, 55, 186, 0, '2015-05-20 12:48:13'),
(10, '', 'On vous a ajoutÃ© dans la liste liste1', 1, 67, 50, 178, 0, '2015-05-20 13:19:22'),
(11, '', 'nouvelle tache "tache lol" dans la liste "liste1"', 1, 67, 50, 178, 0, '2015-05-20 13:20:15'),
(12, '', 'nouvelle tache "tache lol" dans la liste "liste1"', 0, 67, 55, 178, 0, '2015-05-20 13:20:15'),
(13, '', 'nouvelle tache "tache lol" dans la liste "liste1"', 1, 67, 50, 178, 0, '2015-05-20 13:21:22'),
(14, '', 'nouvelle tache "tache lol" dans la liste "liste1"', 0, 67, 55, 178, 0, '2015-05-20 13:21:22'),
(15, '', 'On vous a surpprimÃ© de la liste ma liste de merde', 0, 67, 28, 186, 0, '2015-05-20 13:24:16'),
(16, '', 'On vous a ajoutÃ© dans la liste ma liste de merde', 1, 67, 50, 186, 0, '2015-05-20 13:28:20'),
(17, '', 'On vous a ajoutÃ© dans la liste ma liste de merde', 0, 67, 50, 186, 0, '2015-05-20 13:28:58');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todolist_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text,
  `isChecked` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FOREIGN KEY` (`todolist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `todolist_id`, `name`, `comment`, `isChecked`, `user_id`, `date`) VALUES
(2, 183, 'dd', '', 0, 0, '0000-00-00'),
(3, 183, 'ddd', '', 1, 50, '2015-12-05'),
(4, 180, 'test', '', 0, 0, '2015-05-19'),
(6, 178, 'test Ã© la', '', 1, 67, '2015-05-19'),
(7, 181, 's', '', 0, 0, '0000-00-00'),
(8, 184, 'ghgg', '', 1, 67, '2015-12-05'),
(9, 184, 'liste test', 'mon commentaire prÃ©ferÃ©', 0, 0, '0000-00-00'),
(10, 184, 's', '', 0, 0, '0000-00-00'),
(11, 184, 'cc', '', 0, 0, '0000-00-00'),
(13, 178, 'tache 1', '', 1, 67, '2015-05-19'),
(14, 178, 'tache 2', '', 1, 67, '0000-00-00'),
(15, 178, 'tache 3', '', 1, 67, '0000-00-00'),
(17, 186, 'ma tahc', '', 0, 0, '0000-00-00'),
(18, 178, 'tache lol', '', 0, 0, '0000-00-00'),
(19, 178, 'tache lol', '', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `todolists`
--

CREATE TABLE IF NOT EXISTS `todolists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `text` text,
  `dateBegin` date DEFAULT NULL,
  `dateEnd` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Contenu de la table `todolists`
--

INSERT INTO `todolists` (`id`, `name`, `text`, `dateBegin`, `dateEnd`, `user_id`) VALUES
(178, 'liste1', '', NULL, NULL, 67),
(180, 'ooo', '', NULL, NULL, 67),
(181, 'cc', '', NULL, NULL, 50),
(182, 'cc Ã© ', '', NULL, NULL, 50),
(183, 'test date', '', '2015-05-16', '2015-05-22', 50),
(184, 'test 5', '', NULL, NULL, 67),
(185, 'guigui', '', NULL, NULL, 67),
(186, 'ma liste de merde', '', '2015-05-24', '2015-05-30', 67);

-- --------------------------------------------------------

--
-- Structure de la table `todolist_users`
--

CREATE TABLE IF NOT EXISTS `todolist_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todolist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `todolist_id` (`todolist_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `todolist_users`
--

INSERT INTO `todolist_users` (`id`, `todolist_id`, `user_id`) VALUES
(31, 178, 50),
(25, 178, 55),
(1, 178, 67),
(5, 180, 67),
(7, 181, 50),
(8, 182, 50),
(9, 183, 50),
(14, 184, 67),
(17, 185, 67),
(30, 186, 55),
(26, 186, 67);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `id_facebook` bigint(20) NOT NULL DEFAULT '-1',
  `email` varchar(40) NOT NULL COMMENT 'l''@email',
  `name` varchar(20) NOT NULL COMMENT 'le nom',
  `firstname` varchar(20) NOT NULL COMMENT 'le prenom',
  `birthdate` date NOT NULL COMMENT 'date',
  `gender` tinyint(1) NOT NULL COMMENT 'le sexe',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `id_facebook`, `email`, `name`, `firstname`, `birthdate`, `gender`, `password`) VALUES
(12, -1, 'ggg@hotmail.fr', 'fff', 'ddd', '2015-04-06', 0, 'xxxxxx'),
(13, -1, 'geogeoderemetz3133@hotmail.fr', 'dfdf', 'fdsf', '2015-04-06', 0, 'dfffdf'),
(49, -1, 'g@hotmail.fr', 'erer', 'rerer', '1993-02-27', 1, 'd520312ce4e9a1e0de383acad959071d6a77fd8b'),
(50, 10205566805723221, 'nicolas6920s@hotmail.fr', 'Deremetzz', 'Nicolass', '1991-06-22', 1, 'd2bafe391800cf749d8a4fcc0e57a310c93aea6f'),
(52, -1, 'geo@hotmail.fr', 'deremetz', 'geoffrey', '0000-00-00', 0, 'd520312ce4e9a1e0de383acad959071d6a77fd8b'),
(53, -1, 'honionÃ©@hotmail.fr', 'honion', 'jeffrey', '0000-00-00', 1, 'f32871171d3cc08bfa825aae55dafafef24b99c3'),
(54, 10204547206095453, 'le.king.du88@hotmail.fr', 'Honion', 'Jeffrey', '1994-08-23', 1, 'd2bafe391800cf749d8a4fcc0e57a310c93aea6f'),
(55, 10153269136643624, 'jimm_du_54@hotmail.fr', 'Falck', 'Jimmy', '1992-03-10', 1, 'd2bafe391800cf749d8a4fcc0e57a310c93aea6f'),
(56, -1, 'geogeo@hotmail.fr', 'deremetz', 'geoffrey', '1993-02-27', 1, 'd520312ce4e9a1e0de383acad959071d6a77fd8b'),
(57, -1, 'gg@hotmail.fr', 'fgf', 'gfg', '1993-02-27', 1, 'd520312ce4e9a1e0de383acad959071d6a77fd8b'),
(58, -1, 'fggfgg@hotmail.fr', 'dfdf', 'dfdf', '1993-02-27', 1, '6842a9c7773728f8648af9138b9d6ae30fcee2b2'),
(59, -1, 'gggggggg@hotmail.fr', 'dffdf', 'dfdfd', '1993-02-27', 1, 'dfd8f7d3b9ebad209297f395e17667391d5bfb3c'),
(67, 10206739053344887, 'geogeoderemetz313@hootmail.fr', 'Deremetz', 'Geoffrey', '1993-02-27', 1, 'd2bafe391800cf749d8a4fcc0e57a310c93aea6f'),
(68, -1, 'geo1@hotmail.fr', 'fff', 'fff', '1993-02-27', 1, 'b56c5a7d08d4d94eb1813e8a6db5c3bcb4fc145d');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`todolist_id`) REFERENCES `todolists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `todolist_users`
--
ALTER TABLE `todolist_users`
  ADD CONSTRAINT `todolist_user.todolist` FOREIGN KEY (`todolist_id`) REFERENCES `todolists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `todolist_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
