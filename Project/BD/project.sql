-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Juillet 2017 à 03:26
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `nom_domaine` varchar(50) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `domaine`
--

INSERT INTO `domaine` (`nom_domaine`, `description`) VALUES
('Anglais', 'poser vos questions en Anglais'),
('Architecture', 'poser vos questions en Architecture'),
('Automatique', 'poser vos questions en automatique'),
('Autre science', 'D\'autre question scientifique'),
('Biologie', 'poser vos questions en biologie'),
('Economie', 'poser vos questions en economie'),
('Electrique', 'poser vos questions en éléricité'),
('Français', 'poser vos questions en français'),
('Genie civile', 'poser vos questions en genie civile'),
('Informatique', 'posez vos question en informatique'),
('Math', 'poser vos questions en math'),
('Mécanique', 'poser vos questions en mécanique'),
('Medecine', 'poser vos questions en medecine'),
('Physique', 'posez vos question en physique & chimie'),
('Sociologie', 'poser vos questions en Sociologie');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `nom_domaine` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `titre_quest` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `supprime` tinyint(1) DEFAULT '0',
  `date_quest` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_question`, `nom_domaine`, `email`, `titre_quest`, `question`, `supprime`, `date_quest`) VALUES
(1, 'Informatique', 'oulmane.hakim@hotmail.com', 'Passer variable dans url après #', 'Bonjour,\nJ\'ai un soucis avec une variable dans mon url voici l\'url : /shop.php?id=9#&sid=57 et la variable concernée est sid qui dans mon cas vaut 57.\nMais quand je fais un $_GET[\'sid\'] PHP me dit ceci :\n1\nNotice: Undefined index: sid in /var/www/shopper/shop.php on line 231\nDonc en gros qui sid n\'est pas définit à la ligne 231 cette ligne je mis suis rendu sauf qu\'elle est correcte elle correspond à ceci :\n$getsid = $_GET[\'sid\'];\nQue puis-je faire ?', 0, '2017-01-17 22:02:17'),
(2, 'Anglais', 'belaidaitzeggane@outlook.fr', 'conjugaison', 'comment conjuguer le verbre to be au present? ', 0, '2017-02-28 20:09:27'),
(4, 'Mécanique', 'oulmane.hakim@hotmail.com', 'cours L3 mécanique', 'je m\'adresse aux étudiants L3 ayant des cours de modules methode numérique \r\nveillez me contacter sur ce num 0556541236', 1, '2017-03-01 17:15:08'),
(5, 'Automatique', 'oulmane.hakim@hotmail.com', 'robot', 'je ve faire un robot', 0, '2017-03-01 22:11:13'),
(6, 'Informatique', 'belaidaitzeggane@outlook.fr', 'Checkbox slide', 'Bonjour,\r\n\r\nQuelqu\'un pourrait-il m\'expliquer comment exploiter ce type de bouton (https://proto.io/freebies/onoff/)? Je ne trouve pas grand chose et je me bas avec depuis quelques jours ...\r\n\r\nJe cherche à le mettre sur ON ou OFF en fonction d\'une valeur dans la base de donnée, mais je ne vois pas du tout comment faire ! De ce que je comprends, pour le mettre en ON c\'est \"Checked\" dans le html, et sur OFF il faut le retirer.... Mais comment associer tout ça ? \r\n\r\nMerci pour vos explications', 0, '2017-03-02 21:39:19'),
(7, 'Français', 'oulmane.hakim@hotmail.com', 'TD le 10.6.2017', 'qu\'est vous avez fait chez Amrane ?', 0, '2017-06-26 18:54:45'),
(8, 'Informatique', 'oulmane.hakim@hotmail.com', 'admin', 'question', 0, '2017-07-03 14:40:00');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_rep` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rep` text NOT NULL,
  `supprime` tinyint(1) NOT NULL DEFAULT '0',
  `date_rep` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id_rep`, `id_question`, `email`, `rep`, `supprime`, `date_rep`) VALUES
(1, 1, 'amin.lagab@gmail.com', 'Après le dièse c\'est l\'ancre de la page. Cette ancre n\'est pas envoyé au serveur web. Pour avoir ta variable sid ton url devrait être: /shop.php?id=9&sid=57#', 0, '2017-01-17 23:00:00'),
(2, 2, 'oulmane.hakim@hotmail.com', 'I am \r\nyou are\r\ns/he is\r\nwe are\r\nthey are\r\nc\'est tout', 0, '2017-02-28 20:10:50'),
(3, 2, 'amin.lagab@gmail.com', 'fqsdkjnfjdsqnkjdqsn', 0, '2017-03-01 18:24:46'),
(4, 4, 'amin.lagab@gmail.com', 'le prof n\'a pas encore publier les cours\r\nje pense que la prochaine semaine peut-être', 1, '2017-03-01 18:33:02'),
(5, 1, 'ged.mounir@hotmail.com', 'mais moi ce que je veut c\'est ne pas recharger la page c\'est pour cela que j\'ai inclu le #', 0, '2017-03-02 02:09:23'),
(8, 6, 'yamine.klioui@gmail.com', 'Le bouton va se mettre automatiquement en fonction de la valeur de ta checkbox (checked ou non)\r\n\r\nLorsque tu recupere les valeurs de ta base de donnee il suffit de verifier si la valeur que tu recupere doit checker la box, auquel cas tu met l\'attribut checked=\"checked\"\r\n\r\nsinon tu ne le met pas', 0, '2017-03-02 21:40:05'),
(9, 6, 'belaidaitzeggane@outlook.fr', 'je ne suis pas', 0, '2017-03-04 15:53:34'),
(10, 6, 'oulmane.hakim@hotmail.com', 'dqKFKQNKFqk,snqFLNMLSQmlnSFLKNKSLn\r\nQSFNLqsflmnfQS\r\nqsflnmksqFKLQsf\r\nfsqBKMBQfLQSF', 0, '2017-03-04 22:43:24'),
(11, 6, 'oulmane.hakim@hotmail.com', 'Je poste un message', 0, '2017-07-02 14:43:21'),
(12, 6, 'oulmane.hakim@hotmail.com', 'Rjhh', 0, '2017-07-02 14:43:35'),
(13, 6, 'oulmane.hakim@hotmail.com', '<ol><li><span style=\"line-height: 1.42857143;\">Erth</span><br></li><li><span style=\"line-height: 1.42857143;\">Hgg</span></li><li><span style=\"line-height: 1.42857143;\">Jjkk</span></li></ol>', 0, '2017-07-02 14:44:11'),
(14, 1, 'oulmane.hakim@hotmail.com', 'question<br><ol><li>1er point<br></li></ol>', 0, '2017-07-03 00:25:27'),
(15, 2, 'oulmane.hakim@hotmail.com', 'bkjbqsdbkjq', 0, '2017-07-03 14:51:04');

-- --------------------------------------------------------

--
-- Structure de la table `signaler_quest`
--

CREATE TABLE `signaler_quest` (
  `email` varchar(50) NOT NULL,
  `id_question` int(11) NOT NULL,
  `date_signal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `signaler_quest`
--

INSERT INTO `signaler_quest` (`email`, `id_question`, `date_signal`) VALUES
('hakim.oulmane@gmail.com', 1, '2017-03-05 11:47:29');

-- --------------------------------------------------------

--
-- Structure de la table `signaler_rep`
--

CREATE TABLE `signaler_rep` (
  `email` varchar(50) NOT NULL,
  `id_rep` int(11) NOT NULL,
  `date_signal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `signaler_rep`
--

INSERT INTO `signaler_rep` (`email`, `id_rep`, `date_signal`) VALUES
('oulmane.hakim@hotmail.com', 14, '2017-07-03 00:25:36');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `type` char(1) NOT NULL DEFAULT 'u',
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `bloquer` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`email`, `type`, `nom`, `prenom`, `pseudo`, `age`, `mdp`, `bloquer`) VALUES
('amin.lagab@gmail.com', 'u', 'lagab', 'amin', 'aminlagab95', 22, '55555555', 0),
('belaidaitzeggane@outlook.fr', 'u', 'ait zeggane', 'belaid', 'belaidaitzeggane', 22, '00000000', 0),
('farid.gaya@yahoo.fr', 'u', 'gaya', 'farid', 'faridgaya25', 25, '48564856', 1),
('ged.mounir@hotmail.com', 'u', 'ged', 'mounir', 'gedmounir12', 19, '22222222', 1),
('hakim.oulmane@gmail.com', 'u', 'hakim', 'oulmane', 'oulmanehakim', 22, '48564856', 0),
('oulmane.hakim@hotmail.com', 'u', 'oulmane', 'hakim', 'oulmane_hakim', 22, '48564856', 0),
('yamine.klioui@gmail.com', 'u', 'klioui', 'yamine', 'yamineklioui', 22, '88888888', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`nom_domaine`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `nom_domaine` (`nom_domaine`),
  ADD KEY `nom_domaine_2` (`nom_domaine`),
  ADD KEY `nom_domaine_3` (`nom_domaine`,`email`),
  ADD KEY `email` (`email`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_rep`),
  ADD KEY `id_question` (`id_question`),
  ADD KEY `email` (`email`);

--
-- Index pour la table `signaler_quest`
--
ALTER TABLE `signaler_quest`
  ADD PRIMARY KEY (`email`,`id_question`),
  ADD KEY `id_question` (`id_question`),
  ADD KEY `email` (`email`);

--
-- Index pour la table `signaler_rep`
--
ALTER TABLE `signaler_rep`
  ADD PRIMARY KEY (`email`,`id_rep`),
  ADD KEY `email` (`email`),
  ADD KEY `id_rep` (`id_rep`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`nom_domaine`) REFERENCES `domaine` (`nom_domaine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signaler_quest`
--
ALTER TABLE `signaler_quest`
  ADD CONSTRAINT `signaler_quest_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signaler_quest_ibfk_2` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signaler_rep`
--
ALTER TABLE `signaler_rep`
  ADD CONSTRAINT `email_rep_fk` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idRep_rep_fk` FOREIGN KEY (`id_rep`) REFERENCES `reponse` (`id_rep`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
