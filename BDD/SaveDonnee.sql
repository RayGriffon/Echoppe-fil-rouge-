INSERT INTO `categorie` (`id`, `nom_categorie`, `updated_at`, `image_name`, `description`) VALUES
(1, 'Arme', '2023-05-10 11:33:04', 'armecat-645b72e08d8a9992695610.png', 'Tout ce qui tue'),
(2, 'Armure', '2023-05-10 11:34:47', 'armorcat-645b7347efbd9177616848.jpg', 'Tout ce qui protège'),
(3, 'Magie', '2023-05-10 11:37:24', 'magiecat-645b73e45cbd2058924194.png', 'Tout ce qui est magique'),
(4, 'Divers', '2023-05-10 11:38:42', 'diverscat-645b7432cad5f204031624.jpg', 'Tout le reste'),
(5, 'Epée', '2023-05-10 11:39:52', 'epeecat-645b74781bff7814168601.jpg', 'La classique'),
(6, 'Arc', '2023-05-10 11:42:09', 'arccat-645b750139ad8638257618.jpg', 'Pour les malins'),
(7, 'Plaque', '2023-05-10 11:43:52', 'plaquecat-645b7568b8ea3529901137.jpg', 'La meilleur des protections'),
(8, 'Cuir', '2023-05-10 11:45:35', 'cuircat-645b75cf1f15e613698906.png', 'La plus légère'),
(9, 'Marteau', '2023-05-10 11:46:43', 'marteaucat-645b7613c1f86008899078.jpg', 'Ne sert pas qu\'à écraser'),
(10, 'Lance', '2023-05-10 11:48:38', 'lancecat-645b768614a4a007055733.jpg', 'Toujours utile'),
(12, 'Potion', '2023-05-10 15:17:59', 'potioncat-645ba79754a38776059875.jpg', 'Les indémodables'),
(13, 'Grimoire', '2023-05-15 17:03:03', 'grim-646257b709ff7178278964.jpg', 'Pour les lecteurs avertis');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `categorie_categorie`
--

INSERT INTO `categorie_categorie` (`categorie_source`, `categorie_target`) VALUES
(5, 1),
(6, 1),
(7, 2),
(8, 2),
(9, 1),
(10, 1),
(12, 3),
(13, 3);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom_fournisseur`) VALUES
(1, 'BioTech Industries'),
(2, 'Hephaïstos Inc.'),
(3, 'Bespin Motors'),
(4, 'Kaamelot');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--
-- --------------------------------------------------------

--
-- --------------------------------------------------------

--
-- Structure de la table `produit`
--
--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `fournisseur_id`, `nom_produit`, `description_produit`, `prix_produit`, `tva_produit`, `ref_produit`, `is_online`, `updated_at`) VALUES
(1, 4, 'Excalibur', 'La célèbre épée du roi Arthur.', 2500, 20, 'ARM01', 1, '2023-05-10 11:50:03'),
(2, 2, 'Masamune', 'Un sabre japonais du forgeron éponyme', 2500, 20, 'ARM02', 0, '2023-05-10 11:51:10'),
(3, 1, 'Potion de vie', 'En cas de soucis', 150, 5, 'POT01', 1, '2023-05-10 11:52:54'),
(4, 1, 'Potion de mana', 'En cas de coup de mou', 150, 5, 'POT02', 0, '2023-05-10 11:53:25'),
(5, 1, 'Lambas', 'Nourriture elfique', 14, 20, 'DIV01', 0, '2023-05-11 14:51:39'),
(6, 1, 'Rondache', 'Grand bouclier circulaire', 250, 20, 'BOU01', 0, '2023-05-11 14:52:40'),
(7, 2, 'Gelano', 'Anneau gelax', 20, 20, 'GEL', 0, '2023-05-11 16:23:57'),
(8, 4, 'Sac d\'aventurier', 'Votre futur meilleur ami', 150, 10, 'SAC', 1, '2023-05-11 16:24:25'),
(9, 2, 'Arc elfique', 'L\'arc de Legolas', 150, 2, 'ARC', 0, '2023-05-11 16:29:38'),
(10, 4, 'Anneau unique', 'L\'anneau unique en tirage limité!', 45000, 20, 'ANO2', 0, '2023-05-11 16:30:34'),
(11, 1, 'Parchemin de boule de feu', 'Permet de lancer une boule de feu sans connaître la magie', 1500, 20, 'SCROLL01', 0, '2023-05-11 16:38:57');

-- Structure de la table `photo`
--
--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `produit_id`, `updated_at`, `image_name`) VALUES
(1, 1, '2023-05-11 14:24:50', 'exca1-645ceca2f15a9266199024.jpg'),
(2, 2, '2023-05-11 14:25:53', 'masa1-645cece1b793f632670476.jpg'),
(3, 4, '2023-05-11 14:27:31', 'potmana01-645ced43222c1411718220.png'),
(4, 3, '2023-05-11 14:27:54', 'potvie01-645ced5ae1237677699978.png'),
(5, 5, '2023-05-11 14:53:58', '112-lembas-645cf376cb63e049646633.jpeg'),
(6, 6, '2023-05-11 14:54:09', 'anticstore-large-ref-66736-645cf381ecb66563164841.jpg'),
(7, 7, '2023-05-11 16:24:46', 'gelano-645d08bed81fa647035274.jpeg'),
(8, 8, '2023-05-11 16:25:06', 'capture-d-ecran-du-2023-05-11-16-23-05-645d08d2e9f10591664446.png'),
(10, 9, '2023-05-11 16:32:02', 'arclego-645d0a729bfdd843690686.jpg'),
(11, 10, '2023-05-11 16:35:44', 'ob-87be15-anneau-645d0b5073673914057248.jpg'),
(12, 11, '2023-05-11 16:39:32', '1bxtzph-645d0c343d6af794041515.png'),
(13, 1, '2023-05-16 09:27:00', 'exca2-64633e5473f9d232495270.jpg'),
(14, 10, '2023-05-16 09:43:29', 'anosau-6463423197b18018991375.jpg');
-- --------------------------------------------------------

--
-- Structure de la table `produit_categorie`
--
-- Déchargement des données de la table `produit_categorie`
--

INSERT INTO `produit_categorie` (`produit_id`, `categorie_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 1),
(2, 5),
(5, 4),
(6, 1),
(6, 2),
(7, 3),
(8, 4),
(9, 1),
(9, 6),
(10, 3),
(11, 3);

--
-- Index pour les tables déchargées
--