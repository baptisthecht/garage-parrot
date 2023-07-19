-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 19 juil. 2023 à 00:18
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garageparrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `sender_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_positive` tinyint(1) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `note_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `sender_first_name`, `sender_last_name`, `is_positive`, `comment`, `is_verified`, `note_id`) VALUES
(1, 'Baptist', 'HECHT', 1, 'J\'ai été extrêmement bien accueilli dans ce garage, réparation au top, prix attractifs !', 1, 6),
(11, 'Jean', 'Dubois', 1, 'Super, le vendeur était très accueillant ! Je n\'ai cependant pas trouvé mon bonheur..', 1, 5),
(12, 'Théo', 'Henri', 0, 'On m\'annonce un délai d\'un mois pour changer mes amortisseurs... Pas du tout satisfait !', 1, 2),
(13, 'Guillaume', 'Lamblin', 1, 'J\'ai acheté mon véhicule il y a 2 mois maintenant et j\'en suis entièrement satisfait ! Je conseille à tous.', 1, 6),
(14, 'Julio', 'Pellegrini', 1, 'Bien, vendeur agréable, belles voitures, top !', 0, 5);

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `year` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `climatisation` tinyint(1) NOT NULL,
  `centralisation` tinyint(1) NOT NULL,
  `reg_lim_vitesse` tinyint(1) NOT NULL,
  `auto` tinyint(1) NOT NULL,
  `toit_ouvrant` tinyint(1) NOT NULL,
  `commentaire` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `energy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `price`, `year`, `km`, `main_image`, `climatisation`, `centralisation`, `reg_lim_vitesse`, `auto`, `toit_ouvrant`, `commentaire`, `img2`, `img3`, `img4`, `power`, `energy_id`) VALUES
(1, 'Peugeot', 'e208', 37000, 2022, 2000, 'Peugeot-e-208-restylee-2023-014-9-64b72739b7ff8.jpg', 1, 1, 1, 1, 0, 'Lancée en octobre 2019, la Peugeot e-208 vient concurrencer la Renault ZOE sur le segment des citadines. La e-208 est la première voiture électrique de la marque au lion.', '2214696-652bg8atsm-scaled-64b72739b8270.jpg', 'peugeot-208-big-w770-64b72739b8444.jpg', 'peugeot-e-208-2023-3-64b72739b85a3.jpg', '210', 5),
(2, 'Peugeot', '308', 32000, 2021, 2000, 'peugeot-308-5p-2021-m-1-64b7283ba0682.jpg', 1, 0, 1, 1, 1, 'Avec 160 ch, la nouvelle 308 devient une compacte sportive alléchante, d\'autant qu\'elle dispose d\'un vrai différentiel à glissement limité.', 'peugeot-308-testdrive-0921tc-187-64b7283ba091f.webp', '2-64b7283ba0ca4.jpg', 'NAZ-9e118ba48e654d14b782e819cc876738-64b7283ba0e5c.webp', '160', 2),
(4, 'Lamborghini', 'Aventador', 100000, 2019, 32000, 'car2-64b728af2006d.jpg', 1, 1, 1, 0, 0, 'Avec 890 ch, la Lamborghini Aventador devient LE monstre par excellence, rien, pas même un avion de chasse ne vous fera de tord.', NULL, NULL, NULL, '890', 1),
(5, 'Opel', 'Corsa', 37000, 2023, 1000, 'opel-corsa-electric-2023-64b728ea1b676.jpg', 1, 1, 1, 1, 1, 'Nouvelle calandre, nouveaux phares, boucliers redessinés… le restylage de l’Opel Corsa ne passe pas inaperçu. Celle-ci dispose de la nouvelle signature visuelle « Opel Vizor ».', '2023-opel-corsa-facelift-7-64b728ea1b8bc.jpg', 'Opel-Corsa-2023-facelift-5-64b728ea1bac3.jpg', NULL, '230', 5),
(6, 'Fiat', '500 Hybrid', 4000, 2016, 120000, 'ak22096-64b727bf2288a.jpg', 1, 1, 0, 1, 1, 'Fiat 500 Hybrid est dotée de diverses fonctionnalités technologiques pour vous aider à conduire de manière plus sûre et ainsi profiter au mieux de votre temps à bord.', NULL, NULL, NULL, '140', 6);

-- --------------------------------------------------------

--
-- Structure de la table `carburant`
--

CREATE TABLE `carburant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carburant`
--

INSERT INTO `carburant` (`id`, `name`) VALUES
(1, 'Essence'),
(2, 'Diesel'),
(3, 'GPL'),
(4, 'Ethanol'),
(5, 'Électrique'),
(6, 'Hybride');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `phone`, `subject`, `message`, `lu`) VALUES
(4, 'Parrot', 'Vincent', 'v.parrot@gmail.com', '0612345678', 'Au sujet de Peugeot 308 de 2021', 'Bonjour, je vous contacte car j\'aimerai avoir des photos de l\'intérieur (TDB et sièges) s\'il vous plait, Merci', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230714201154', '2023-07-14 20:11:59', 28),
('DoctrineMigrations\\Version20230714220411', '2023-07-14 22:04:18', 27),
('DoctrineMigrations\\Version20230714230249', '2023-07-14 23:02:58', 60),
('DoctrineMigrations\\Version20230717124854', '2023-07-17 12:49:00', 62);

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id` int(11) NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `is_closed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id`, `day`, `open_time`, `close_time`, `is_closed`) VALUES
(1, 'Lundi', '09:00:00', '17:00:00', 0),
(2, 'Mardi', '10:00:00', '18:00:00', 0),
(3, 'Mercredi', '13:00:00', '18:00:00', 0),
(4, 'Jeudi', '09:00:00', '18:00:00', 1),
(5, 'Vendredi', '12:00:00', '18:00:00', 0),
(6, 'Samedi', '09:00:00', '18:00:00', 0),
(7, 'Dimanche', '10:00:00', '18:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mark`
--

CREATE TABLE `mark` (
  `id` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mark`
--

INSERT INTO `mark` (`id`, `note`) VALUES
(1, '0'),
(2, '1'),
(3, '2'),
(4, '3'),
(5, '4'),
(6, '5');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_de_service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `name`, `description`, `available`, `image`, `type_de_service_id`) VALUES
(1, 'Vidange', 'Remplacement de l\'huile et de tout les filtres du véhicule.', 0, 'faire-une-vidange-dune-voiture-64b72a780bdd1.webp', 2),
(2, 'Bougies', 'Remplacement des bougies d\'allumage ou de préchauffage.', 1, 'Unknown-64b72a8a940dc.jpg', 1),
(3, 'Pneus', 'Remplacement des pneumatiques de votre véhicule (par deux)', 1, 'mains-seulement-mecanicien-tenant-pneu-au-garage-reparation-remplacement-pneus-hiver-ete-146671-16784-jpg-64b72a991e81a.avif', 2),
(4, 'Freins', 'Changement de vos disques et plaquettes de freins avant', 1, 'disque-frein-ventile-main-13186753-64b72ac81fd98.jpg', 2),
(5, 'Décalaminage', 'Décalaminage du moteur pour tout type de moteur diesel', 1, 'qu-est-ce-que-le-decalaminage-moteur-681-64b72b1691fb3.jpg', 2),
(21, 'Pare-brise', 'Remplacement de votre pare-brise en cas d\'impact ou de brisure', 1, 'dreamstime-s-19403267-64b72b0e545a2.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_de_service`
--

CREATE TABLE `type_de_service` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_de_service`
--

INSERT INTO `type_de_service` (`id`, `nom`) VALUES
(1, 'Réparation'),
(2, 'Entretien'),
(3, 'Urgence'),
(4, 'Dépannage');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `prenom`, `nom`) VALUES
(1, 'v.parrot@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$1s24qhwaODI.HN7gvXns0.0AZ.zuzJV1sxki/X6YMTwI2w7kKHWc.', 'Vincent', 'Parrot'),
(2, 'j.philippe@gmail.com', '[\"ROLE_EMPLOYEE\"]', '$2y$13$dpEPKHVHr8qQBXC2vLkM8uQdzLbHap1Wv85NAzhbfoYRBzVzTJ5Yu', 'Jean', 'Philippe'),
(3, 'ba@gmail.com', '[\"ROLE_EMPLOYEE\"]', '$2y$13$a5dSMuYsREs5kY.x5n08C.5vZNrsW/s80jpqopbWYLES3SAgu45l.', 'Baptist', 'HECHT');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F91ABF026ED0855` (`note_id`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_773DE69DEDDF52D` (`energy_id`);

--
-- Index pour la table `carburant`
--
ALTER TABLE `carburant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E19D9AD2E4B2B215` (`type_de_service_id`);

--
-- Index pour la table `type_de_service`
--
ALTER TABLE `type_de_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `carburant`
--
ALTER TABLE `carburant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `type_de_service`
--
ALTER TABLE `type_de_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF026ED0855` FOREIGN KEY (`note_id`) REFERENCES `mark` (`id`);

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `FK_773DE69DEDDF52D` FOREIGN KEY (`energy_id`) REFERENCES `carburant` (`id`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_E19D9AD2E4B2B215` FOREIGN KEY (`type_de_service_id`) REFERENCES `type_de_service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
