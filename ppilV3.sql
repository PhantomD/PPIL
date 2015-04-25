-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 25 Avril 2015 à 16:34
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
-- Structure de la table `commentary`
--

CREATE TABLE IF NOT EXISTS `commentary` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todolist_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text,
  `idChecked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FOREIGN KEY` (`todolist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `todolist_id`, `name`, `comment`, `idChecked`) VALUES
(13, 46, 'dfdff', '', 0),
(14, 46, 'f', '', 0),
(15, 46, 'e', '', 0),
(16, 46, 'd', '', 0),
(17, 46, 'fgfg', '', 0),
(18, 46, 'd', '', 0),
(19, 46, 'fggg', '', 0),
(20, 46, 'ff', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `todolists`
--

INSERT INTO `todolists` (`id`, `name`, `text`, `dateBegin`, `dateEnd`, `user_id`) VALUES
(46, 'test', '', NULL, NULL, 6),
(47, 'fgfggg', '', NULL, NULL, 6),
(48, 'user2', NULL, NULL, NULL, 3),
(49, 'user2', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `todolist_users`
--

CREATE TABLE IF NOT EXISTS `todolist_users` (
  `todolist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`todolist_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pseudo` varchar(20) NOT NULL COMMENT 'le pseudo',
  `email` varchar(40) NOT NULL COMMENT 'l''@email',
  `name` varchar(20) NOT NULL COMMENT 'le nom',
  `firstname` varchar(20) NOT NULL COMMENT 'le prenom',
  `birthdate` date NOT NULL COMMENT 'date',
  `gender` tinyint(1) NOT NULL COMMENT 'le sexe',
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `name`, `firstname`, `birthdate`, `gender`, `phone`, `password`) VALUES
(1, 'xxxxx', 'gg@hotmail.fr', 'xx', 'xx', '1993-02-27', 1, '', 'b0e7046dfa48873ff202c6277f86c21aebcf78de'),
(2, 'testt', 'geo@hotmail.fr', 'test', 'test', '1993-02-27', 1, '', 'b0e7046dfa48873ff202c6277f86c21aebcf78de'),
(3, 'tests', 'geoo@hotmail.fr', 'test', 'test', '1993-02-27', 1, '', 'b0e7046dfa48873ff202c6277f86c21aebcf78de'),
(6, 'geo', 'ggf@hotmail.fr', 'deremetz', 'geoffrey', '1980-02-27', 0, '', 'd520312ce4e9a1e0de383acad959071d6a77fd8b');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`todolist_id`) REFERENCES `todolists` (`id`);

--
-- Contraintes pour la table `todolist_users`
--
ALTER TABLE `todolist_users`
  ADD CONSTRAINT `todolist_users_ibfk_1` FOREIGN KEY (`toDoList_id`) REFERENCES `todolists` (`id`),
  ADD CONSTRAINT `todolist_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
