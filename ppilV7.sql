-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 10 Mai 2015 à 23:37
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Contenu de la table `commentaries`
--

INSERT INTO `commentaries` (`ID`, `text`, `task_id`, `user_id`) VALUES
(54, 'cxcc', 25, 67),
(55, 'hihi', 25, 67),
(56, 'oo', 25, 67),
(57, 'errr', 25, 67),
(58, 'dd', 25, 67),
(59, 'dd', 25, 67),
(60, 'd', 25, 67),
(61, 'sd', 25, 67),
(62, 'z', 25, 67),
(63, 's', 25, 67),
(64, 'd', 25, 67),
(65, 'dd', 25, 67),
(66, 'ah ah', 25, 67),
(67, 'ah ah ', 25, 67),
(68, 'cklllllllllllllllllllllddp dp fd pdf odfkd ld dl fd dl kdfj dl jfd jdl d dlf ldj dl jd jfdl jd jdl jd jdl jdzlfn fnm fzmlfz ml fmzf zm', 25, 67),
(69, 'cklllllllllllllllllllll cklllllllllllllllllllllddp dp fd pdf odfkd ld dl fd dl kdfj dl jfd jdl d dlf ldj dl jd jfdl jd jdl jd jdl jdzlfn fnm fzmlfz ml fmzf zmdp dp fd pdf odfkd ld dl fd dl kdfj dl jfd jdl d dlf ldj dl jd jfdl jd jdl jd jdl jdzlfn fnm fzmlfz ml fmzf zm cklllllllllllllllllllllddp dp fd pdf odfkd ld dl fd dl kdfj dl jfd jdl d dlf ldj dl jd jfdl jd jdl jd jdl jdzlfn fnm fzmlfz ml fmzf zm', 25, 67);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `isReaded` tinyint(1) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `todolist_id`, `name`, `comment`, `isChecked`, `user_id`, `date`) VALUES
(25, 169, 'jj', '', 0, 0, '0000-00-00'),
(26, 169, 'ddd', '', 1, 67, '2015-10-05'),
(27, 169, 'vvv', NULL, 1, 50, '2015-10-05'),
(28, 169, 'aaa', '', 0, 0, '0000-00-00'),
(29, 173, 'fgfgfdgfd', '', 1, 67, '2015-10-05');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=175 ;

--
-- Contenu de la table `todolists`
--

INSERT INTO `todolists` (`id`, `name`, `text`, `dateBegin`, `dateEnd`, `user_id`) VALUES
(131, 'test', '', NULL, NULL, 48),
(134, 'ddd', '', NULL, NULL, 50),
(136, 'dfff', '', NULL, NULL, 52),
(137, 'dff', '', NULL, NULL, 52),
(138, 'ee', 'je ne sais pas trop quoi dire', '1993-02-27', NULL, 52),
(144, 'liste1', '', NULL, NULL, 53),
(147, 'dfdf', '', NULL, NULL, 51),
(148, 'eere', '', NULL, NULL, 51),
(149, 'eere', '', NULL, NULL, 51),
(151, 'eff', '', NULL, NULL, 51),
(152, 'dfdff', '', NULL, NULL, 56),
(153, 'd', '', NULL, NULL, 56),
(154, 'rtt', '', '1993-02-27', '1995-02-24', 56),
(155, 'dfdff', '', '0000-00-00', '0000-00-00', 56),
(156, 'dddd', '', '1970-01-01', '1970-01-01', 56),
(157, 'ddd', '', NULL, NULL, 56),
(158, 'aaa', '', NULL, NULL, 56),
(159, 'bbbb', '', '2016-02-27', NULL, 56),
(165, 'ghghh', '', NULL, NULL, 68),
(166, 'pp', '', NULL, NULL, 68),
(167, 'liste1', '', NULL, NULL, 67),
(168, 'liste2', '', NULL, NULL, 67),
(169, 'dfdff', '', '2015-05-09', NULL, 67),
(170, 'ffdff', '', '2015-05-12', NULL, 67),
(171, 'cvcvcvcv', '', '2015-06-09', NULL, 67),
(172, 'pourquoi ', '', NULL, NULL, 67),
(173, 'off', '', NULL, NULL, 67),
(174, 'euh', '', '2015-05-10', NULL, 67);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Contenu de la table `todolist_users`
--

INSERT INTO `todolist_users` (`id`, `todolist_id`, `user_id`) VALUES
(37, 131, 12),
(38, 134, 12),
(42, 136, 52),
(43, 137, 52),
(44, 138, 52),
(50, 144, 53),
(56, 147, 50),
(64, 152, 56),
(65, 153, 56),
(66, 154, 56),
(67, 155, 56),
(68, 156, 56),
(69, 157, 56),
(70, 158, 56),
(71, 159, 56),
(77, 165, 68),
(78, 166, 68),
(79, 167, 67),
(80, 168, 67),
(86, 169, 50),
(87, 169, 54),
(88, 169, 55),
(81, 169, 67),
(82, 170, 67),
(83, 171, 67),
(84, 172, 67),
(85, 173, 67),
(89, 174, 67);

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
(50, 10205566805723221, 'nicolas6920s@hotmail.fr', 'Deremetz', 'Nicolas', '1990-06-22', 1, 'd2bafe391800cf749d8a4fcc0e57a310c93aea6f'),
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
