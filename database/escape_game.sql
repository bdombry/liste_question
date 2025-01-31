-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 jan. 2025 à 11:21
-- Version du serveur : 11.5.2-MariaDB
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `escape_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `reponse` varchar(255) NOT NULL,
  `message_succes` text NOT NULL,
  `message_echec` text NOT NULL,
  `reussites` int(11) DEFAULT 0,
  `tentatives` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `reponse`, `message_succes`, `message_echec`, `reussites`, `tentatives`) VALUES
(1, 'Ou ce situe la NWS', 'Rouen', 'Bien joué tu es près à faire des persona', 'Ratio vas a la fac', 3, 4),
(3, 'Dans quelle continent se situe la france ?', 'Europe', 'Plus fort qu\'un américain !', 'La honte de la famille c\'est toi.', 0, 1),
(5, 'Quel est la spé ou on travaille le plus', 'développement', 'tap-in', 'surtout pas les CD !! (ni les market...)', 2, 5),
(6, 'le projet etait plus facile que celui d\'hier ?', 'oui', 'bv', 'loser', 5, 5),
(7, 'Est-ce que cette question est utile ?', 'oui', 't\'es bon !!', 'pour les tester son travail mon grand :)', 1, 1),
(8, 'Qui est le plus moche de la school ?', 'l\'élève qui sèche ! :(', 'Laurolaï vas pas être contente !!!', 'Cette réponse sera transmise à la personne concerné avec ton nom prénom !!', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
