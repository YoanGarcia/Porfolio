-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 15 Septembre 2017 à 17:14
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
  `titre` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `competences`
--

INSERT INTO `competences` (`id`, `titre`, `points`) VALUES
(22, 'HTML 5', 4),
(23, 'CSS 3', 4);

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
(2, 'photo', 'aze photo', 'qwertya', 'lion.png', '22h15min'),
(3, 'photo', 'aze photo', 'qwertya', 'lion.png', '22h15min'),
(4, 'photo', 'aze photo', 'qwertya', 'lion.png', '22h15min'),
(5, 'photo', 'aze photo', 'qwertya', 'lion.png', '22h15min'),
(6, 'illu', 'aze illu', 'qwertya', 'lion.png', '22h15min'),
(7, 'illu', 'aze illu', 'qwertya', 'lion.png', '22h15min'),
(8, 'illu', 'aze illu', 'qwertya', 'lion.png', '22h15min'),
(9, 'illu', 'aze illu', 'qwertya', 'lion.png', '22h15min'),
(10, 'illu', 'aze illu', 'qwertya', 'lion.png', '22h15min'),
(11, 'c3ds', 'aze c3ds', 'qwertya', 'lion.png', '22h15min'),
(12, 'c3ds', 'aze c3ds', 'qwertya', 'lion.png', '22h15min'),
(13, 'c3ds', 'aze c3ds', 'qwertya', 'lion.png', '22h15min'),
(14, 'c3ds', 'aze c3ds', 'qwertya', 'lion.png', '22h15min'),
(15, 'c3ds', 'aze c3ds', 'qwertya', 'lion.png', '22h15min'),
(36, 'c3ds', 'ajout des azeazeazez', 'azeqdazesdfdsgsersdregfxdtxdegm^*lpm^gfhdftdgbdrgdxbg', '1505139326.jpg', '02h35minutes'),
(38, 'illu', 'azeaze', 'azeazeazeazeqsdqsd', '1505483582.jpg', 'azeazeaze'),
(39, 'illu', 'azeazeaze', 'azeazeaze', '1505483706.png', 'azeazeaze'),
(40, 'c3ds', 'logo test', 'zerzerzarze', '1505484252.png', 'zerzreze'),
(41, 'c3ds', 'logo test', 'zerzerzarze', '1505487617.png', 'zerzreze'),
(42, 'c3ds', 'logo test', 'zerzerzarze', '1505487640.png', 'zerzreze');

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
(1, 'yoan.gcia@gmail.com', '06 40 13 59 33', 'Après avoir obtenu mon BAC STL (Sciences Techniques de Laboratoire), j''ai voulu tenter l''écologie et la prévention. Au bout d’une année dans l''IUT HSE (Hygiène Santé Environnement) de Tulle, je me suis réorienté vers une passion née dès mon plus jeune âge : le jeu vidéo.J''intègre donc ESTEI à Bordeaux où je suis actuellement un bachelor (BAC+3) en infographie/multimédia dans le but de travailler dans le jeu vidéo plutôt du côté de l''image (graphisme, modélisation).', 'photoCV.png', 'CV.pdf');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `creations`
--
ALTER TABLE `creations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
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
