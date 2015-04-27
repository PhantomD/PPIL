-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Avril 2015 à 17:36
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
  PRIMARY KEY (`id`),
  KEY `FOREIGN KEY` (`todolist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Contenu de la table `todolists`
--

INSERT INTO `todolists` (`id`, `name`, `text`, `dateBegin`, `dateEnd`, `user_id`) VALUES
(124, 'sd', '', NULL, NULL, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `todolist_users`
--

INSERT INTO `todolist_users` (`id`, `todolist_id`, `user_id`) VALUES
(1, 124, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `name`, `firstname`, `birthdate`, `gender`, `phone`, `password`) VALUES
(1, 'xxxxx', 'gg@hotmail.fr', 'xx', 'xx', '1993-02-27', 1, '', 'b0e7046dfa48873ff202c6277f86c21aebcf78de'),
(2, 'testt', 'geo@hotmail.fr', 'test', 'test', '1993-02-27', 1, '', 'b0e7046dfa48873ff202c6277f86c21aebcf78de'),
(3, 'tests', 'geoo@hotmail.fr', 'test', 'test', '1993-02-27', 1, '', 'b0e7046dfa48873ff202c6277f86c21aebcf78de'),
(6, 'geo', 'ggzfz@hotmail.fr', 'deremetz', 'geoffrey', '1980-02-27', 1, '', 'd520312ce4e9a1e0de383acad959071d6a77fd8b'),
(7, 'coucou', 'gggg@hotmail.fr', 'cestmoi', 'oupas', '1993-02-27', 1, '', '3aa76fd1fb5717bf90f452496cea83f1f8a1b669'),
(8, '', '', '', '', '0000-00-00', 0, '', ''),
(10, 'tytytyty', '', '', '', '0000-00-00', 0, '', ''),
(11, 'rtrtret', 'ertetetett', 'ertetet', 'ertetete', '2015-04-09', 1, '', 'rtetertet');

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
  ADD CONSTRAINT `todolist_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `todolist_user.todolist` FOREIGN KEY (`todolist_id`) REFERENCES `todolists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
