-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 fév. 2026 à 17:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `car_rental`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT 'default-car.jpg',
  `available` tinyint(1) DEFAULT 1,
  `rating` decimal(2,1) DEFAULT 0.0,
  `reviews_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `name`, `description`, `price_per_day`, `image`, `available`, `rating`, `reviews_count`) VALUES
(1, 'BMW X5', 'Luxury SUV with powerful engine and comfortable interior. Perfect for family trips and long journeys.', 89.99, 'bmw-x5.jpg', 1, 4.6, 5),
(2, 'Audi A6', 'Elegant business sedan with advanced technology and smooth ride. Ideal for professionals.', 79.99, 'audi-a6.jpg', 1, 4.6, 5),
(3, 'Mercedes C-Class', 'Premium compact executive car with exceptional comfort and style.', 85.99, 'mercedes-c.jpg', 1, 4.8, 4),
(4, 'Renault Clio', 'Economical and agile city car. Perfect for urban driving with great fuel efficiency.', 39.99, 'renault-clio.jpg', 1, 4.5, 4),
(5, 'Peugeot 3008', 'Modern compact SUV with spacious interior and cutting-edge technology.', 69.99, 'peugeot-3008.jpg', 1, 4.8, 4),
(6, 'Isuzu Dmax', 'Powerful pickup truck built for work and adventure. Excellent towing capacity.', 90.00, 'isuzu-dmax.jpg', 1, 4.8, 4),
(7, 'Tesla Model 3', 'Électrique haute performance avec autonomie de 500km. Accélération 0-100km/h en 3.3s, technologie de pointe et conduite autonome.', 120.00, 'tesla-model3.jpg', 1, 4.6, 7),
(8, 'Ford Mustang', 'Icône américaine V8 5.0L. Puissance brute, design légendaire et son de moteur inimitable. Pour les amateurs de sensations fortes.', 150.00, 'ford-mustang.jpg', 1, 4.8, 8);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `car_id` int(11) NOT NULL,
  `car_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `days` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review_title` varchar(255) DEFAULT NULL,
  `review_text` text NOT NULL,
  `approved` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `car_id`, `customer_name`, `customer_email`, `rating`, `review_title`, `review_text`, `approved`, `created_at`) VALUES
(1, 1, 'John Smith', 'john@email.com', 5, 'Amazing SUV!', 'The BMW X5 is incredibly comfortable and powerful. Perfect for long family trips. The handling is superb and the interior is luxurious.', 1, '2026-02-16 15:53:01'),
(2, 1, 'Sarah Johnson', 'sarah@email.com', 5, 'Best car ever', 'I rented this for a weekend and fell in love. So smooth on highway and great fuel economy for such a big car.', 1, '2026-02-16 15:53:01'),
(3, 1, 'Michael Brown', 'michael@email.com', 4, 'Very good but expensive', 'Excellent car, clean and well maintained. A bit pricey but worth it for the quality.', 1, '2026-02-16 15:53:01'),
(4, 1, 'Emma Wilson', 'emma@email.com', 5, 'Perfect for family', 'Spacious, safe, and comfortable. My kids loved it. Will rent again!', 1, '2026-02-16 15:53:01'),
(5, 1, 'David Lee', 'david@email.com', 4, 'Great condition', 'Car was spotless and ran perfectly. Pickup and dropoff were very easy.', 1, '2026-02-16 15:53:01'),
(6, 2, 'James Taylor', 'james@email.com', 5, 'Elegant and smooth', 'The Audi A6 is pure class. Very quiet interior, amazing sound system, and drives like a dream.', 1, '2026-02-16 15:53:01'),
(7, 2, 'Lisa Anderson', 'lisa@email.com', 5, 'Love this car!', 'So comfortable for long drives. The seats are amazing and the technology is top notch.', 1, '2026-02-16 15:53:01'),
(8, 2, 'Robert Martin', 'robert@email.com', 4, 'Great business car', 'Perfect for client meetings. Looks professional and drives beautifully.', 1, '2026-02-16 15:53:01'),
(9, 2, 'Patricia White', 'patricia@email.com', 5, 'Excellent service', 'Car was ready on time, very clean, and performed flawlessly.', 1, '2026-02-16 15:53:01'),
(10, 2, 'Charles Davis', 'charles@email.com', 4, 'Very nice', 'Smooth ride, good acceleration, and very comfortable. Would rent again.', 1, '2026-02-16 15:53:01'),
(11, 3, 'Jennifer Miller', 'jennifer@email.com', 5, 'Luxury at its best', 'The Mercedes C-Class is absolutely gorgeous. Interior is stunning and the ride is so smooth.', 1, '2026-02-16 15:53:01'),
(12, 3, 'Thomas Wilson', 'thomas@email.com', 5, 'Outstanding car', 'Everything about this car is perfect. Performance, comfort, style. 10/10.', 1, '2026-02-16 15:53:01'),
(13, 3, 'Nancy Brown', 'nancy@email.com', 4, 'Very elegant', 'Beautiful car, very clean and well maintained. A bit tight in the back seat but perfect for 2 people.', 1, '2026-02-16 15:53:01'),
(14, 3, 'Daniel Johnson', 'daniel@email.com', 5, 'Best rental experience', 'Car was like new, very clean, and the rental process was super easy.', 1, '2026-02-16 15:53:01'),
(15, 4, 'Sophie Martin', 'sophie@email.com', 5, 'Perfect city car', 'The Clio is so easy to park and maneuver in the city. Great fuel economy too!', 1, '2026-02-16 15:53:01'),
(16, 4, 'Pierre Dubois', 'pierre@email.com', 4, 'Good little car', 'Very economical and fun to drive. Perfect for short trips and city driving.', 1, '2026-02-16 15:53:01'),
(17, 4, 'Marie Lambert', 'marie@email.com', 5, 'Excellent value', 'For the price, this car is amazing. Clean, reliable, and easy to drive.', 1, '2026-02-16 15:53:01'),
(18, 4, 'Luc Bernard', 'luc@email.com', 4, 'Nice small car', 'Good condition, drives well, and very affordable. Would recommend.', 1, '2026-02-16 15:53:01'),
(19, 5, 'Antoine Petit', 'antoine@email.com', 5, 'Modern and spacious', 'The 3008 is very modern with great technology. Spacious inside and comfortable for long drives.', 1, '2026-02-16 15:53:01'),
(20, 5, 'Julie Moreau', 'julie@email.com', 5, 'Love this SUV', 'Perfect size, not too big not too small. Great view of the road and very comfortable seats.', 1, '2026-02-16 15:53:01'),
(21, 5, 'Nicolas Roux', 'nicolas@email.com', 4, 'Very good car', 'Clean, modern, and drives very well. The interior is really nice.', 1, '2026-02-16 15:53:01'),
(22, 5, 'Isabelle Leroy', 'isabelle@email.com', 5, 'Excellent family car', 'Plenty of space for luggage and kids. Very safe and comfortable ride.', 1, '2026-02-16 15:53:01'),
(23, 6, 'Mark Johnson', 'mark@email.com', 5, 'Powerful truck!', 'The Dmax is a beast. Handled everything I threw at it. Perfect for work and off-road.', 1, '2026-02-16 15:53:01'),
(24, 6, 'Sarah Connor', 'sarah.c@email.com', 5, 'Amazing for camping', 'Took this truck camping and it was perfect. Lots of space and very capable off-road.', 1, '2026-02-16 15:53:01'),
(25, 6, 'Tom Hardy', 'tom@email.com', 4, 'Very strong', 'Great power and towing capacity. Fuel economy could be better but it\'s a truck!', 1, '2026-02-16 15:53:01'),
(26, 6, 'Emma Stone', 'emma@email.com', 5, 'Surprisingly comfortable', 'I expected a rough ride but it was very comfortable. Great truck overall.', 1, '2026-02-16 15:53:01'),
(27, 7, 'Thomas Dubois', 'thomas.d@email.com', 5, 'Révolution électrique !', 'Je n\'avais jamais conduit de voiture électrique avant. La Tesla Model 3 est une révélation ! Accélération instantanée, silence de fonctionnement, technologie incroyable. Je suis conquis.', 1, '2026-02-16 16:13:45'),
(28, 7, 'Marie Lambert', 'marie.l@email.com', 5, 'Futuriste et économique', 'Superbe voiture, très confortable et tellement économique par rapport à l\'essence. L\'autonomie de 500km est bien réelle. Parfaite pour les longs trajets.', 1, '2026-02-16 16:13:45'),
(29, 7, 'Pierre Martin', 'pierre.m@email.com', 4, 'Très bonne voiture', 'Technologie impressionnante, conduite agréable. Seul petit bémol : le temps de recharge sur les longs trajets. Mais pour un usage quotidien, c\'est parfait.', 1, '2026-02-16 16:13:45'),
(30, 7, 'Sophie Bernard', 'sophie.b@email.com', 5, 'Un vrai bonheur', 'Silencieuse, rapide, connectée. Le grand écran central est génial. Plus jamais je ne reviendrai à l\'essence !', 1, '2026-02-16 16:13:45'),
(31, 7, 'Jean Dupont', 'jean.d@email.com', 5, 'La meilleure voiture', 'J\'ai loué cette Tesla pour un weekend et j\'ai déjà envie d\'en acheter une. L\'accélération est dingue, et le mode \"Ludicrous\" est un vrai jeu d\'enfant !', 1, '2026-02-16 16:13:45'),
(32, 7, 'Claire Moreau', 'claire.m@email.com', 4, 'Très agréable', 'Conduite fluide, intérieur épuré et moderne. Le régulateur adaptatif est un must pour les autoroutes. Je recommande !', 1, '2026-02-16 16:13:45'),
(33, 8, 'Nicolas Legrand', 'nicolas.l@email.com', 5, 'Légende américaine !', 'Le bruit du V8 est une pure musique. Puissance brute, look iconique. Conduire une Mustang, c\'est vivre un rêve américain !', 1, '2026-02-16 16:13:45'),
(34, 8, 'Julie Renard', 'julie.r@email.com', 5, 'Voiture de caractère', 'Elle a du charisme, de la gueule, et ce bruit... Incroyable. Parfaite pour les balades le week-end. Tout le monde la regarde !', 1, '2026-02-16 16:13:45'),
(35, 8, 'Marc Antoine', 'marc.a@email.com', 4, 'Puissante mais gourmande', 'Quel bonheur de conduire cette voiture ! La puissance est là à chaque accélération. Par contre, prévoyez un budget essence conséquent... Mais ça vaut le coup !', 1, '2026-02-16 16:13:45'),
(36, 8, 'Caroline Petit', 'caroline.p@email.com', 5, 'Coup de cœur absolu', 'Je l\'ai louée pour l\'anniversaire de mon mari et il était aux anges. Design magnifique, conduite sportive. Une voiture qui fait rêver.', 1, '2026-02-16 16:13:45'),
(37, 8, 'David Leroy', 'david.l@email.com', 5, 'Mustang forever', 'J\'ai toujours rêvé de conduire une Mustang. Elle dépasse toutes mes attentes. Le V8 gronde, la puissance est là. Un pur bonheur !', 1, '2026-02-16 16:13:45'),
(38, 8, 'Isabelle Morel', 'isabelle.m@email.com', 4, 'Très belle voiture', 'Super look, très agréable à conduire. Un peu ferme pour les longs trajets mais tellement stylée qu\'on lui pardonne.', 1, '2026-02-16 16:13:45'),
(39, 8, 'François Delacroix', 'francois.d@email.com', 5, 'Mustang GT, le mythe', 'V8 5.0L, 450 chevaux, bruit d\'enfer. C\'est une voiture qui procure des sensations uniques. À conduire au moins une fois dans sa vie !', 1, '2026-02-16 16:13:45'),
(40, 8, 'rayen hmida ', 'r@gmailcom', 5, 'Top car !', 'Best muscle car', 1, '2026-02-16 16:15:17'),
(41, 7, 'Mathiew', 'm@gmail.com', 4, 'nice', 'Good performance and battery saving ', 1, '2026-02-16 16:16:25');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
