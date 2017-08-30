-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Août 2017 à 14:41
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `yoan`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `competences`
--

INSERT INTO `competences` (`id`, `name`, `titre`, `points`) VALUES
(1, 'html', 'HTML 5', 4),
(2, 'css', 'CSS 3', 4),
(3, 'php', 'PHP', 3),
(4, 'js', 'Javascript', 2),
(5, 'office', 'Suite Office', 4),
(6, 'photo', 'Adobe Photoshop', 3),
(7, 'illustrator', 'Adobe Illustrator', 4),
(8, 'anglais', 'Anglais', 4);

-- --------------------------------------------------------

--
-- Structure de la table `creations`
--

CREATE TABLE `creations` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `creations`
--

INSERT INTO `creations` (`id`, `type`, `titre`, `description`, `img`, `temp`) VALUES
(1, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(2, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(3, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(4, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(5, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(6, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(7, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(8, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(9, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(10, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(11, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(12, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(13, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(14, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(15, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(16, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(17, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(18, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(19, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(20, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(21, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(22, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(23, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(24, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(25, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(26, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(27, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(28, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(29, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(30, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(31, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min'),
(32, 'photo', 'azea', 'qwertya', 'lion.png', '22h15min');

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `lien_cv` varchar(255) NOT NULL,
  `apropos` text NOT NULL,
  `photoCV` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`id`, `email`, `telephone`, `lien_cv`, `apropos`, `photoCV`) VALUES
(1, 'yoan.gcia@gmail.com', '06 40 13 59 33', 'http://www.google.fr', 'Après avoire obtenu mon BAC STL (Sciences Techniques de Laboratoire), j''ai voulu tenter l''écologie et la prévention. Au bout d’une année dans l''IUT HSE (Hygiène Santé Environnement) de Tulle, je me suis réorienté vers une passion née dès mon plus jeune âge : le jeu vidéo.J''intègre donc ESTEI à Bordeaux où je suis actuellement un bachelor (BAC+3) en infographie/multimédia dans le but de travailler dans le jeu vidéo plutôt du côté de l''image (graphisme, modélisation).', 'photoCV.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `role`) VALUES
(1, 'yoan', '$2y$10$KjiIgoBOfGAlZ05KD/.RYOjhBfQwhlEG5pzCveyWLRiJpckpi45wS', 'admin');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `creations`
--
ALTER TABLE `creations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `creations`
--
ALTER TABLE `creations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
