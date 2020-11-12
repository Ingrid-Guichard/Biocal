-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 26 mai 2019 à 23:12
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `biocal_vf`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `ID_Achat` int(50) NOT NULL,
  `ID_commande` int(50) NOT NULL,
  `ID_Produit` int(50) NOT NULL,
  `Quantité` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`ID_Achat`, `ID_commande`, `ID_Produit`, `Quantité`) VALUES
(1, 2, 25, 2),
(2, 2, 26, 2),
(3, 2, 25, 1),
(4, 2, 29, 3),
(5, 2, 2, 2),
(6, 2, 45, 3),
(7, 2, 28, 7),
(8, 2, 22, 4),
(9, 3, 30, 2),
(10, 3, 32, 2),
(11, 3, 34, 1),
(12, 3, 1, 3),
(13, 3, 38, 2),
(14, 3, 56, 3),
(15, 3, 61, 7),
(16, 3, 65, 1),
(17, 4, 35, 2),
(18, 4, 31, 2),
(19, 4, 20, 1),
(20, 4, 47, 3),
(21, 4, 58, 2),
(22, 4, 2, 3),
(23, 4, 3, 3),
(24, 4, 55, 1),
(25, 5, 25, 2),
(26, 5, 27, 2),
(27, 5, 24, 1),
(28, 5, 30, 3),
(29, 5, 3, 2),
(30, 5, 46, 3),
(31, 5, 29, 7),
(32, 5, 8, 4),
(33, 6, 31, 2),
(34, 6, 33, 2),
(35, 6, 35, 1),
(36, 6, 2, 3),
(37, 6, 48, 2),
(38, 6, 57, 3),
(39, 6, 62, 7),
(40, 6, 64, 1),
(41, 7, 35, 2),
(42, 7, 31, 2),
(43, 7, 20, 1),
(44, 7, 47, 4),
(45, 7, 58, 2),
(46, 7, 2, 5),
(47, 7, 3, 2),
(48, 7, 15, 5),
(49, 8, 65, 2),
(50, 8, 24, 2),
(51, 8, 21, 1),
(52, 8, 30, 3),
(53, 8, 3, 2),
(54, 8, 46, 3),
(55, 8, 29, 7),
(56, 8, 23, 4),
(57, 9, 30, 2),
(58, 9, 32, 2),
(59, 9, 34, 5),
(60, 9, 1, 3),
(61, 9, 29, 2),
(62, 9, 55, 3),
(63, 9, 61, 3),
(64, 9, 65, 1),
(65, 9, 35, 2),
(66, 10, 58, 2),
(67, 10, 1, 1),
(68, 10, 2, 6),
(69, 10, 3, 7),
(70, 10, 5, 3),
(71, 10, 11, 3),
(72, 10, 47, 1),
(73, 11, 59, 2),
(74, 11, 2, 1),
(75, 11, 47, 3),
(76, 11, 3, 10),
(77, 11, 6, 3),
(78, 11, 12, 3),
(79, 11, 34, 1),
(80, 12, 25, 11),
(81, 12, 26, 12),
(82, 13, 25, 15),
(83, 13, 29, 8),
(84, 13, 2, 12),
(85, 14, 45, 6),
(86, 14, 28, 10),
(87, 14, 22, 10),
(88, 15, 30, 12),
(89, 15, 32, 12),
(90, 15, 34, 6),
(91, 16, 1, 13),
(92, 16, 38, 6),
(93, 17, 56, 7),
(94, 17, 61, 7),
(95, 17, 65, 8),
(96, 17, 35, 2),
(97, 17, 31, 2),
(98, 17, 20, 1),
(99, 17, 47, 3),
(100, 17, 58, 2),
(101, 16, 2, 3),
(102, 16, 3, 3),
(103, 17, 55, 1),
(104, 16, 25, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categorie` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categorie`) VALUES
('cremerie'),
('epicerie salee'),
('epicerie sucree'),
('fruits et legumes'),
('viande et poisson');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `ID_client` int(20) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Adresse` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Telephone` int(50) NOT NULL,
  `Compte_fidelite` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`ID_client`, `Nom`, `Prenom`, `Adresse`, `email`, `Telephone`, `Compte_fidelite`) VALUES
(1, 'Clerc', 'Sybille', '45 Impasse de Château Gaillard 34000 Montpellier', 'sybille.clerc@free.fr', 645678765, 'oui'),
(2, 'Martin', 'Benjamin', '37 Allée des Vergnes 34000 Montpellier', 'benjamin.martin@free.fr', 689876168, 'oui'),
(3, 'Dubois', 'Vincent', '20 rue Fraçois Perier 34000 Montpellier', 'vincentdubois@free.fr', 765512098, 'oui'),
(4, 'Deschamps', 'Cyrille', '50 rue d\'Isle 34970 Lattes', 'cyrille.78@sfr.fr', 789983421, 'oui'),
(5, 'Durand', 'Orianne', '14 Allée Theodore Gericault 34470 Pérols', 'durand.orianne@gmail.com', 754334567, 'non'),
(6, 'Dupont', 'Pascale', '46 Rue Gustave Dore 31000 Toulouse', 'dupondup@free.fr', 656763213, 'non'),
(7, 'Laporte', 'Benjamin', '44 Rue François Alluaud 44000 Nantes', 'benjamin.laporte89@free.fr', 623187654, 'non');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `ID_Commande` int(50) NOT NULL,
  `Date` date NOT NULL,
  `Etat_Commande` varchar(50) NOT NULL,
  `ID_Client` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`ID_Commande`, `Date`, `Etat_Commande`, `ID_Client`) VALUES
(2, '2019-04-10', 'Livrée', 1),
(3, '2019-05-15', 'En cours de livraison', 1),
(4, '2019-04-11', 'Livrée', 2),
(5, '2019-05-12', 'En cours de préparation', 2),
(6, '2019-04-12', 'Livrée', 3),
(7, '2019-05-13', 'En cours de préparation', 3),
(8, '2019-04-14', 'Livrée', 4),
(9, '2019-05-17', 'En cours de livraison', 4),
(10, '2019-04-17', 'Livrée', 5),
(11, '2019-05-09', 'Livrée', 5),
(12, '2019-04-01', 'Livrée', 6),
(13, '2019-05-02', 'En cours de livraison', 5),
(14, '2019-04-11', 'Livrée', 6),
(15, '2019-05-20', 'En cours de préparation', 6),
(16, '2019-04-27', 'Livrée', 7),
(17, '2019-05-22', 'En cours de préparation', 7);

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE `livraisons` (
  `ID_Livraison` int(11) NOT NULL,
  `ID_Commande` int(50) NOT NULL,
  `Date_prévue` date NOT NULL,
  `Date_effective` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livraisons`
--

INSERT INTO `livraisons` (`ID_Livraison`, `ID_Commande`, `Date_prévue`, `Date_effective`) VALUES
(1, 2, '2019-04-09', '2019-04-09'),
(2, 4, '2019-04-16', '2019-04-16'),
(3, 6, '2019-04-17', '2019-04-18'),
(4, 8, '2019-04-19', '2019-04-20'),
(5, 10, '2019-04-24', '2019-04-24'),
(6, 11, '2019-05-16', '2019-05-17'),
(7, 12, '2019-04-08', '2019-04-10'),
(8, 14, '2019-04-18', '2019-04-18'),
(9, 16, '2019-05-03', '2019-05-04'),
(10, 3, '2019-05-22', '2019-05-26'),
(11, 5, '2019-05-19', '2019-05-26'),
(12, 7, '2019-05-20', '2019-05-26'),
(13, 9, '2019-05-24', '2019-05-26'),
(14, 13, '2019-05-09', '2019-05-26'),
(15, 16, '2019-05-27', '2019-05-26'),
(16, 17, '2019-05-29', '2019-05-26'),
(17, 13, '2019-05-14', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `producteurs`
--

CREATE TABLE `producteurs` (
  `ID_producteur` int(20) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `producteurs`
--

INSERT INTO `producteurs` (`ID_producteur`, `Nom`, `Adresse`) VALUES
(0, 'Les fruits du Soleil', '144 Boulevard Pedro de Luna'),
(2, 'Le jardin de Vic', '26 Route de Montpellier'),
(3, 'Boucherie chez Pierrot', '20 rue Fraçois Perier 34000 Montpellier'),
(4, 'L\'huître Rieuse', '50 rue d\'Isle 34970 Lattes'),
(5, 'Crèmerie du Faubourg ', '14 Allée Theodore Gericault 34470 Pérols'),
(6, 'La Terre des Fieux', 'Route de l\'apparition 34000 Montpellier'),
(7, 'Le comptoir Gourmand', '1 Rue Saint-Guilhem 34000 Montpellier');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `ID_Produit` int(20) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Prix` float NOT NULL,
  `Quantité` int(50) NOT NULL,
  `categories_produit` varchar(50) NOT NULL,
  `sous_categories_produit` varchar(50) NOT NULL,
  `ID_Producteur` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`ID_Produit`, `Nom`, `Description`, `Prix`, `Quantité`, `categories_produit`, `sous_categories_produit`, `ID_Producteur`) VALUES
(1, 'Bananes', 'Bio', 2.5, 43, 'fruits et legumes', 'fruits de saisons', 0),
(2, 'Fraises', 'Bio', 4.2, 30, 'fruits et legumes', 'fruits de saisons', 0),
(3, 'Poires', 'Bio', 2.8, 23, 'fruits et legumes', 'fruits de saisons', 0),
(4, 'Pommes', 'Bio', 1.55, 19, 'fruits et legumes', 'fruits de saisons', 0),
(5, 'Oranges', 'Bio', 1.05, 80, 'fruits et legumes', 'fruits de saisons', 0),
(6, 'Mangue', 'Bio', 4.7, 11, 'fruits et legumes', 'fruits de saisons', 0),
(7, 'Ananas', 'Bio', 3.65, 23, 'fruits et legumes', 'fruits de saisons', 0),
(8, 'Framboises', 'Bio', 7.55, 22, 'fruits et legumes', 'fruits de saisons', 0),
(9, 'Kiwis', 'Bio', 6.55, 46, 'fruits et legumes', 'fruits de saisons', 0),
(10, 'Clémentines', 'Bio', 3.8, 57, 'fruits et legumes', 'fruits de saisons', 0),
(11, 'Abricots', 'Bio', 3.66, 64, 'fruits et legumes', 'fruits de saisons', 0),
(12, 'Melons', 'Bio', 2.5, 10, 'fruits et legumes', 'fruits de saisons', 0),
(13, 'Nectarine', 'Bio', 3.05, 27, 'fruits et legumes', 'fruits de saisons', 0),
(14, 'Petits pois', 'Bio', 1.85, 35, 'fruits et legumes', 'legumes de saison', 2),
(15, 'Haricots verts', 'Bio', 2.99, 46, 'fruits et legumes', 'legumes de saison', 2),
(16, 'Haricots blanc', 'Bio', 3.65, 34, 'fruits et legumes', 'legumes de saison', 2),
(17, 'Chou', 'Bio', 4, 22, 'fruits et legumes', 'legumes de saison', 2),
(18, 'Courgette', 'Bio', 8, 53, 'fruits et legumes', 'legumes de saison', 2),
(19, 'Concombre', 'Bio', 2, 21, 'fruits et legumes', 'legumes de saison', 2),
(20, 'Pommes de terres', 'Bio', 1, 12, 'fruits et legumes', 'legumes de saison', 2),
(21, 'Artichaut', 'Bio', 2, 27, 'fruits et legumes', 'legumes de saison', 2),
(22, 'Brocolis', 'Bio', 2, 43, 'fruits et legumes', 'legumes de saison', 2),
(23, 'Aubergine', 'Bio', 3, 25, 'fruits et legumes', 'legumes de saison', 2),
(24, 'Poivrons', 'Bio', 2, 16, 'fruits et legumes', 'legumes de saison', 2),
(25, 'Poireaux', 'Bio', 5, 32, 'fruits et legumes', 'legumes de saison', 2),
(26, 'Célerie', 'Bio', 1, 6, 'fruits et legumes', 'legumes de saison', 2),
(27, 'Radis', 'Bio', 6, 34, 'fruits et legumes', 'legumes de saison', 2),
(28, 'Carottes', 'Bio', 2, 57, 'fruits et legumes', 'legumes de saison', 2),
(29, 'Mache', 'Bio', 7, 29, 'fruits et legumes', 'legumes de saison', 2),
(30, 'Laitue', 'Bio', 8, 48, 'fruits et legumes', 'legumes de saison', 2),
(31, 'Endive', 'Bio', 2, 17, 'fruits et legumes', 'legumes de saison', 2),
(32, 'Ail', 'Du japon', 2, 26, 'fruits et legumes', 'ail, oignon, echalotte', 2),
(33, 'Oignon', 'Du japon', 2, 35, 'fruits et legumes', 'ail, oignon, echalotte', 2),
(34, 'Thon', 'Elevage biologique', 18, 7, 'viande et poisson', 'poisson', 4),
(35, 'Cabillaud', 'Elevage biologique', 17, 15, 'viande et poisson', 'poisson', 4),
(36, 'Crevettes', 'Elevage biologique', 9, 28, 'viande et poisson', 'poisson', 4),
(37, 'Saumon', 'Elevage biologique', 6, 42, 'viande et poisson', 'poisson', 4),
(38, 'Porc', 'Elevage biologique', 14, 22, 'viande et poisson', 'porc', 3),
(39, 'Veau', 'Elevage biologique', 16, 2, 'viande et poisson', 'veau', 3),
(40, 'Lapin', 'Elevage biologique', 13, 17, 'viande et poisson', 'lapin', 3),
(41, 'Boeuf', 'Elevage biologique', 21, 43, 'viande et poisson', 'boeuf', 3),
(42, 'Canard', 'Elevage biologique', 19, 38, 'viande et poisson', 'canard', 3),
(43, 'Volaille', 'Elevage biologique', 14, 42, 'viande et poisson', 'volaille', 3),
(44, 'Boeuf', 'Elevage biologique', 21, 43, 'viande et poisson', 'boeuf', 3),
(45, 'Jambon blanc', 'Espagne', 14, 45, 'viande et poisson', 'charcuterie', 3),
(46, 'Jambon sec', 'Espagne', 18, 26, 'viande et poisson', 'charcuterie', 3),
(47, 'Oeuf', 'Oeufs frais', 4, 36, 'viande et poisson', 'oeuf', 3),
(48, 'Lait', 'Bio', 1, 40, 'cremerie', 'lait', 5),
(49, 'Beurre', 'Bio', 2, 36, 'cremerie', 'beurre et crème', 5),
(55, 'Crème fraiche', 'Epaisse', 2, 14, 'cremerie', 'beurre et crème', 5),
(56, 'Emmental', 'Bio', 4, 25, 'cremerie', 'fromage', 5),
(57, 'Roblochon', 'Bio de Savoie', 16, 5, 'cremerie', 'fromage', 5),
(58, 'Chèvre frais', 'Bio', 3, 13, 'cremerie', 'fromage', 5),
(59, 'Huile olive', 'Extra vierge bio', 7, 27, 'epicerie salee', 'huile et vinaigre', 6),
(60, 'Vinaigre', 'bio', 5, 29, 'epicerie salee', 'huile et vinaigre', 6),
(61, 'Pâtes', 'Blé complet', 2, 43, 'epicerie salee', 'pates et riz', 6),
(62, 'Riz', 'Blé complet', 1, 34, 'epicerie salee', 'pates et riz', 6),
(63, 'Miel', 'Bio', 14, 7, 'epicerie sucree', 'miel', 7),
(64, 'Confiture fraises', 'Bio', 2, 10, 'epicerie sucree', 'compote', 7),
(65, 'Confiture framboises', 'Bio', 3, 9, 'epicerie sucree', 'compote', 7);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `sous_categorie` varchar(24) NOT NULL,
  `categorie` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`sous_categorie`, `categorie`) VALUES
('beurre et creme', 'cremerie'),
('fromage', 'cremerie'),
('lait', 'cremerie'),
('oeuf', 'cremerie'),
('huile et vinaigre', 'epicerie salee'),
('legumineuse et cereales', 'epicerie salee'),
('pates et riz', 'epicerie salee'),
('cereales', 'epicerie sucree'),
('compote', 'epicerie sucree'),
('farine', 'epicerie sucree'),
('fruits secs', 'epicerie sucree'),
('miel', 'epicerie sucree'),
('ail, oignon, echalotte', 'fruits et legumes'),
('champignons', 'fruits et legumes'),
('chou', 'fruits et legumes'),
('courge', 'fruits et legumes'),
('fruits a coque', 'fruits et legumes'),
('fruits de saisons', 'fruits et legumes'),
('herbe et salade', 'fruits et legumes'),
('legumes de saison', 'fruits et legumes'),
('legumes oublies', 'fruits et legumes'),
('pomme de terre', 'fruits et legumes'),
('racine', 'fruits et legumes'),
('boeuf', 'viande et poisson'),
('canard', 'viande et poisson'),
('charcuterie', 'viande et poisson'),
('lapin', 'viande et poisson'),
('poisson', 'viande et poisson'),
('porc', 'viande et poisson'),
('veau', 'viande et poisson'),
('volaille', 'viande et poisson');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`ID_Achat`),
  ADD KEY `pdt` (`ID_Produit`),
  ADD KEY `com` (`ID_commande`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorie`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID_client`) USING BTREE;

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`ID_Commande`),
  ADD KEY `client` (`ID_Client`);

--
-- Index pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`ID_Livraison`),
  ADD KEY `cmd` (`ID_Commande`);

--
-- Index pour la table `producteurs`
--
ALTER TABLE `producteurs`
  ADD PRIMARY KEY (`ID_producteur`) USING BTREE;

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`ID_Produit`) USING BTREE,
  ADD KEY `Producteur` (`ID_Producteur`),
  ADD KEY `scategories` (`sous_categories_produit`),
  ADD KEY `categories` (`categories_produit`);

--
-- Index pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`sous_categorie`),
  ADD KEY `cat` (`categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `ID_Achat` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID_client` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `ID_Commande` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `ID_Livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `producteurs`
--
ALTER TABLE `producteurs`
  MODIFY `ID_producteur` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `ID_Produit` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `com` FOREIGN KEY (`ID_commande`) REFERENCES `commandes` (`ID_Commande`),
  ADD CONSTRAINT `pdt` FOREIGN KEY (`ID_Produit`) REFERENCES `produits` (`ID_Produit`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `client` FOREIGN KEY (`ID_Client`) REFERENCES `clients` (`ID_client`);

--
-- Contraintes pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD CONSTRAINT `cmd` FOREIGN KEY (`ID_Commande`) REFERENCES `commandes` (`ID_Commande`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `Producteur` FOREIGN KEY (`ID_Producteur`) REFERENCES `producteurs` (`ID_producteur`),
  ADD CONSTRAINT `categories` FOREIGN KEY (`categories_produit`) REFERENCES `categories` (`categorie`),
  ADD CONSTRAINT `scategories` FOREIGN KEY (`sous_categories_produit`) REFERENCES `sous_categories` (`sous_categorie`);

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `cat` FOREIGN KEY (`categorie`) REFERENCES `categories` (`categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
