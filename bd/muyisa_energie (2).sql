-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 04:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muyisa_energie`
--

-- --------------------------------------------------------

--
-- Table structure for table `bondesortie`
--

CREATE TABLE `bondesortie` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `libelle` text NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bondesortie`
--

INSERT INTO `bondesortie` (`id`, `dates`, `libelle`, `montant`, `supprimer`) VALUES
(1, '2025-05-13', 'achat materiel', 150, 0),
(2, '2025-05-13', 'frais de transport', 200, 1),
(3, '2025-05-13', 'payement logiciel', 88, 0);

-- --------------------------------------------------------

--
-- Table structure for table `camion`
--

CREATE TABLE `camion` (
  `id` int(11) NOT NULL,
  `plaque` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camion`
--

INSERT INTO `camion` (`id`, `plaque`, `supprimer`) VALUES
(1, 'RDC0666', 0),
(2, 'UG01944', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chargement`
--

CREATE TABLE `chargement` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `camion` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chargement`
--

INSERT INTO `chargement` (`id`, `dates`, `camion`, `commande`, `supprimer`) VALUES
(2, '2025-06-05', 1, 14, 1),
(3, '2025-06-05', 1, 14, 0),
(4, '2025-06-27', 1, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `numero` varchar(50) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `photo` text NOT NULL,
  `genre` varchar(2) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`numero`, `nom`, `postnom`, `prenom`, `photo`, `genre`, `telephone`, `supprimer`) VALUES
('ME0001', 'kambale ', 'kilima', 'julien', '1745405356.jpg', 'M', '0977139499', 0),
('ME0002', 'kambale ', 'kamala', 'albert', '1745403341.jpg', 'M', '0971402590', 0),
('ME0003', 'kam', 'kok', 'kkk', '1745405631.jpg', 'F', '0977139490', 1),
('ME0004', 'kamla', 'lll', 'lll', '1745405932.jpg', 'F', '0977139490', 1),
('ME0005', 'kambale', 'kasika', 'joseph', '1747818765.jpg', 'M', '0991147629', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `client` text NOT NULL,
  `type` int(11) NOT NULL,
  `numfacture` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `dates`, `client`, `type`, `numfacture`, `statut`, `supprimer`) VALUES
(2, '2025-07-16', 'ME0001', 2, 1, 1, 0),
(4, '2025-07-16', 'kasereka', 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `commande_ap`
--

CREATE TABLE `commande_ap` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `numcommande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande_ap`
--

INSERT INTO `commande_ap` (`id`, `dates`, `fournisseur`, `numcommande`, `supprimer`) VALUES
(14, '2025-06-05', 1, 14, 0),
(15, '2025-06-27', 1, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `declarant`
--

CREATE TABLE `declarant` (
  `numero` varchar(20) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `genre` varchar(2) NOT NULL,
  `telephone` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `declarant`
--

INSERT INTO `declarant` (`numero`, `nom`, `postnom`, `prenom`, `genre`, `telephone`, `supprimer`) VALUES
('DE0001', 'kambale', 'kamala', 'albert', 'M', '0977139499', 0),
('DE0002', 'kkkkk', 'kkkkk', 'kkkkkk', 'F', '0971402590', 1);

-- --------------------------------------------------------

--
-- Table structure for table `declarer`
--

CREATE TABLE `declarer` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `chargement` int(11) NOT NULL,
  `declarant` varchar(20) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `declarer`
--

INSERT INTO `declarer` (`id`, `dates`, `chargement`, `declarant`, `montant`, `supprimer`) VALUES
(2, '2025-06-05', 3, 'DE0001', 9000, 1),
(3, '2025-06-05', 3, 'DE0001', 9000, 0),
(4, '2025-06-27', 4, 'DE0001', 12000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `entree`
--

CREATE TABLE `entree` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `type` text NOT NULL,
  `reste_argent` double NOT NULL,
  `PR` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entree`
--

INSERT INTO `entree` (`id`, `dates`, `commande`, `quantite`, `type`, `reste_argent`, `PR`, `supprimer`) VALUES
(1, '2025-07-07', 15, 60000, 'essence', 0, 2.2, 0),
(2, '2025-07-16', 14, 39000, 'mazout', 3400, 3.631, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `adresse` text NOT NULL,
  `telephone` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `postnom`, `prenom`, `adresse`, `telephone`, `supprimer`) VALUES
(1, 'kiro', 'mwenge', 'laur', 'beni', '0971402590', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mois`
--

CREATE TABLE `mois` (
  `id` int(11) NOT NULL,
  `mois` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mois`
--

INSERT INTO `mois` (`id`, `mois`) VALUES
(1, 'janvier'),
(2, 'fevrier'),
(3, 'mars'),
(4, 'avril'),
(5, 'mai'),
(6, 'juin'),
(7, 'juillet'),
(8, 'Aout'),
(9, 'septembre'),
(10, 'octobre'),
(11, 'novembre'),
(12, 'decembre');

-- --------------------------------------------------------

--
-- Table structure for table `nonlivrer`
--

CREATE TABLE `nonlivrer` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite_essence` double NOT NULL,
  `quantite_mazout` double NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nonlivrer`
--

INSERT INTO `nonlivrer` (`id`, `dates`, `commande`, `quantite_essence`, `quantite_mazout`, `statut`, `supprimer`) VALUES
(1, '2025-05-16', 32, 27, 14, 1, 0),
(2, '2025-05-17', 33, 0, 70, 0, 0),
(3, '2025-05-21', 34, 14, 7, 1, 0),
(4, '2025-05-21', 35, 0, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `paiment_declaration`
--

CREATE TABLE `paiment_declaration` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `declaration` int(11) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiment_declaration`
--

INSERT INTO `paiment_declaration` (`id`, `dates`, `declaration`, `montant`, `supprimer`) VALUES
(1, '2025-06-20', 3, 1000, 0),
(2, '2025-06-20', 3, 1000, 0),
(3, '2025-06-20', 3, 500, 0),
(4, '2025-06-20', 3, 1500, 0),
(5, '2025-06-20', 3, 2000, 0),
(6, '2025-06-20', 3, 3000, 0),
(7, '2025-06-27', 4, 2000, 0),
(8, '2025-06-29', 4, 1500, 0),
(9, '2025-06-29', 4, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `paiment_dette`
--

CREATE TABLE `paiment_dette` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiment_dette`
--

INSERT INTO `paiment_dette` (`id`, `dates`, `commande`, `montant`, `supprimer`) VALUES
(1, '2025-05-14', 9, 23, 0),
(2, '2025-05-14', 9, 20000, 0),
(3, '2025-05-14', 9, 254477, 0),
(4, '2025-05-14', 12, 500, 0),
(5, '2025-05-14', 19, 336000, 0),
(6, '2025-05-15', 8, 1000, 0),
(7, '2025-05-15', 22, 200, 0),
(8, '2025-05-17', 27, 500, 0),
(9, '2025-05-21', 26, 170, 0),
(10, '2025-05-21', 26, 30, 0),
(11, '2025-05-21', 32, 720, 0),
(12, '2025-05-22', 8, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `type` text NOT NULL,
  `type_achat` text NOT NULL,
  `quantite` double NOT NULL,
  `prixunitaire` double NOT NULL,
  `PR` double NOT NULL,
  `entree` int(11) NOT NULL,
  `resultat` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `commande`, `type`, `type_achat`, `quantite`, `prixunitaire`, `PR`, `entree`, `resultat`, `supprimer`) VALUES
(1, 2, 'essence', 'litre', 1, 2.4, 2.2, 7, 0.2, 0),
(4, 2, 'essence', 'fut', 1, 500, 2.2, 7, 44.6, 0),
(5, 4, 'essence', 'litre', 2, 2.4, 2.2, 7, 0.4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `panier_ap`
--

CREATE TABLE `panier_ap` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `prixunitaire` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier_ap`
--

INSERT INTO `panier_ap` (`id`, `type`, `commande`, `quantite`, `prixunitaire`, `supprimer`) VALUES
(16, 'mazout', 14, 40, 3400, 0),
(17, 'essence', 15, 60, 2000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `matricule` varchar(15) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `photo` text NOT NULL,
  `genre` varchar(1) NOT NULL,
  `telephone` text NOT NULL,
  `fonction` text NOT NULL,
  `salaire` double NOT NULL,
  `date_embauche` date NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`matricule`, `nom`, `postnom`, `prenom`, `photo`, `genre`, `telephone`, `fonction`, `salaire`, `date_embauche`, `supprimer`) VALUES
('AG-0001', 'kambale', 'kamala', 'albert', '1746983396.jpg', 'M', '0977139499', 'gerant', 200, '2025-05-11', 0),
('AG-0002', 'kambale', 'Kilima', 'julien', '1747049990.jpg', 'M', '0977134499', 'comptable', 150, '2025-05-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `type` text NOT NULL,
  `prix_detail` double NOT NULL,
  `prix_gros` double NOT NULL,
  `entree` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prix`
--

INSERT INTO `prix` (`id`, `dates`, `type`, `prix_detail`, `prix_gros`, `entree`, `supprimer`) VALUES
(7, '2025-07-16', 'essence', 2.4, 500, 1, 0),
(8, '2025-07-17', 'mazout', 4.001, 810.007, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `remuneration`
--

CREATE TABLE `remuneration` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `personnel` text NOT NULL,
  `montant` double NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remuneration`
--

INSERT INTO `remuneration` (`id`, `dates`, `personnel`, `montant`, `mois`, `annee`, `supprimer`) VALUES
(1, '2025-05-12', 'AG-0001', 40, 1, '2025', 0),
(2, '2025-05-12', 'AG-0001', 150, 1, '2025', 0),
(3, '2025-05-12', 'AG-0001', 8, 1, '2025', 0),
(4, '2025-05-12', 'AG-0001', 2, 1, '2025', 0),
(5, '2025-05-12', 'AG-0002', 150, 1, '2025', 0),
(6, '2025-05-12', 'AG-0002', 150, 2, '2025', 0),
(7, '2025-05-12', 'AG-0002', 150, 3, '2025', 0),
(8, '2025-05-12', 'AG-0002', 150, 4, '2025', 0),
(9, '2025-05-12', 'AG-0002', 50, 5, '2025', 0),
(11, '2025-05-12', 'AG-0001', 200, 2, '2025', 0),
(12, '2025-05-12', 'AG-0001', 100, 3, '2025', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `quantite` int(11) NOT NULL,
  `type` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taux`
--

CREATE TABLE `taux` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `equivalent` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taux`
--

INSERT INTO `taux` (`id`, `dates`, `equivalent`, `supprimer`) VALUES
(1, '2025-04-22', 2850, 0),
(2, '2025-04-22', 2000, 0),
(3, '2025-04-22', 2900, 0),
(4, '2025-04-22', 2908, 0),
(5, '2025-04-22', 2900, 0),
(6, '2025-04-28', 2850, 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `fonction` text NOT NULL,
  `photo` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `postnom`, `prenom`, `fonction`, `photo`, `username`, `password`, `supprimer`) VALUES
(1, 'kambale', 'kiLIM', 'julien', 'caissiere', '1745823599.jpg', 'julienkiLIM.@me.drc', '0101', 0),
(2, 'kmk', 'kkk', 'klkk', 'admin', 'sscru3.webp', 'klkkkkk.@me.drc', '8898', 0),
(3, 'kambale', 'kamala', 'albert', 'gerant', '1745404332.jpg', 'albertkamala.@me.drc', '0101', 0),
(4, 'muhindo', 'kombi', 'jospin', 'comptable', '1747163126.jpg', 'jospinkombi.@me.drc', '0101', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bondesortie`
--
ALTER TABLE `bondesortie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chargement`
--
ALTER TABLE `chargement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande_ap`
--
ALTER TABLE `commande_ap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declarant`
--
ALTER TABLE `declarant`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `declarer`
--
ALTER TABLE `declarer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonlivrer`
--
ALTER TABLE `nonlivrer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paiment_declaration`
--
ALTER TABLE `paiment_declaration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paiment_dette`
--
ALTER TABLE `paiment_dette`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panier_ap`
--
ALTER TABLE `panier_ap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`matricule`);

--
-- Indexes for table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remuneration`
--
ALTER TABLE `remuneration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taux`
--
ALTER TABLE `taux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bondesortie`
--
ALTER TABLE `bondesortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `camion`
--
ALTER TABLE `camion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chargement`
--
ALTER TABLE `chargement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commande_ap`
--
ALTER TABLE `commande_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `declarer`
--
ALTER TABLE `declarer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entree`
--
ALTER TABLE `entree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mois`
--
ALTER TABLE `mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nonlivrer`
--
ALTER TABLE `nonlivrer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paiment_declaration`
--
ALTER TABLE `paiment_declaration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paiment_dette`
--
ALTER TABLE `paiment_dette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `panier_ap`
--
ALTER TABLE `panier_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `remuneration`
--
ALTER TABLE `remuneration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taux`
--
ALTER TABLE `taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
