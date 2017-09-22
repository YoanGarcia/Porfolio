-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 18 Septembre 2017 à 11:10
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `yoangarchcbdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `competences`
--

INSERT INTO `competences` (`id`, `titre`, `points`) VALUES
(22, 'HTML 5', 4),
(23, 'CSS 3', 4),
(25, 'PHP', 3),
(26, 'Javascript', 2),
(27, 'Suite office', 5),
(28, 'Adobe Photoshop', 3),
(29, 'Adobe Illustrator', 4),
(30, 'Anglais', 4);

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
(44, 'c3ds', 'Plateau de jeu', 'Ce plateau de jeu, ses pions, son dé, les cartes de personnages et les jetons ont été créés par 3 personnes dont moi lors d''un travail sur la revisite d''un jeu de société. Nous devions d''abord dessiner l''ensemble du jeu et de ses éléments puis les modélis', '1505581767.jpg', '2 semaines à 3 personnes'),
(45, 'photo', 'Les 24h du Mans 2017', 'Réalisation d''une affiche sur les 24h du Mans 2017 lors d''un exercice en classe', '1505582095.jpg', '3h'),
(46, 'photo', 'La Place de la Bourse', 'Exercice en cours. Il fallait réaliser une affiche en modifiant une photo pré-existante pour lui donner une ambiance apocalyptique', '1505582256.jpg', '2h'),
(47, 'illu', '3D isométrique', 'Reproduction la plus fidèle possible d''une photo issue d''un jeu lors d''un exercice en classe', '1505582337.jpg', '2h30'),
(48, 'illu', 'HQ21 de Boom Beach', 'Reproduction la plus fidèle possible d''une image du jeu vidéo Boom Beach lors d''un exercice en classe', '1505582660.jpg', '7h'),
(49, 'illu', 'Les Simpson', 'Reproduction la plus fidèle possible d''une photo des Simpson. Fait en classe', '1505582987.jpg', '5h'),
(50, 'illu', 'Les Watchmen Simpsonnisés', 'Dessin puis création sur illustrator de ma version des Watchmen mis au goût des Simpson', '1505583087.jpg', '8h');

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `apropos` text NOT NULL,
  `photoCV` varchar(255) NOT NULL,
  `CV` varchar(255) NOT NULL DEFAULT 'CV.pdf'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`id`, `email`, `telephone`, `apropos`, `photoCV`, `CV`) VALUES
(1, 'yoan.gcia@hotmail.fr', '06 40 13 59 33', 'Après avoir obtenu mon BAC STL (Sciences Techniques de Laboratoire), j''ai voulu tenter l''écologie et la prévention. Au bout d’une année dans l''IUT HSE (Hygiène Santé Environnement) de Tulle, je me suis réorienté vers une passion née dès mon plus jeune âge : le jeu vidéo.\r\n<br><br>\r\nJ''intègre donc ESTEI à Bordeaux où je suis actuellement un bachelor (BAC+3) en infographie/multimédia dans le but de travailler dans le jeu vidéo plutôt du côté de l''image (graphisme, modélisation).', 'photoCV.png', 'CV.pdf');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `creations`
--
ALTER TABLE `creations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
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
