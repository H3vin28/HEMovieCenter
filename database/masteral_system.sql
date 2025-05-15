-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 01:07 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masteral_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `genre` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `usertype` varchar(10) NOT NULL DEFAULT 'user',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `fullname`, `email`, `username`, `genre`, `password`, `status`, `usertype`, `date_created`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin', '', 'M2MyY2NlYzg4NWRiMDQ2Njg3NGM2NmM3YjA5MGQxNzY=', 1, 'admin', '2025-04-10 10:15:51'),
(11, 'dada', 'dada@dada', 'dadas', 'Action, Sci-Fi, Animation', 'Y2IyZDA3ZTdiMTFkOWVmOTcxYjcyZWYzODZiNTA3Mzk=', 1, 'user', '2025-04-10 16:36:43'),
(12, 'Shomoy', 'shomoy@shomoy.com', 'shomoy28', 'Adventure, Comedy', 'Y2YxY2IxOTMzODQyODcyZTM3NzljYjUyZjZjNTk4OTQ=', 1, 'user', '2025-04-30 11:22:18'),
(13, 'dwe', 'dsd@dsw.com', 'dssds', 'Animation, Sci-Fi', 'MGQ4OWJiODY2OWI2NGQzNTI1MmUzMWQ4YWI3Nzg2N2I=', 1, 'user', '2025-05-15 15:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Biography'),
(5, 'Comedy'),
(6, 'Crime'),
(7, 'Documentary'),
(8, 'Drama'),
(9, 'Family'),
(10, 'Fantasy'),
(11, 'History'),
(12, 'Horror'),
(13, 'Music'),
(14, 'Musical'),
(15, 'Mystery'),
(16, 'Romance'),
(17, 'Sci-Fi'),
(18, 'Sport'),
(19, 'Thriller'),
(20, 'War'),
(21, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `firstname` int(11) NOT NULL,
  `lastname` int(11) NOT NULL,
  `middle_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year_released` varchar(10) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `file_name` text NOT NULL,
  `description` text NOT NULL,
  `rating` double(10,1) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year_released`, `genre`, `file_name`, `description`, `rating`, `status`, `date_created`) VALUES
(1, 'Inception', '2010', 'Action, Sci-Fi', 'Inception.jpg', 'A thief who enters dreams to steal secrets is given a task to plant an idea.', 0.0, 1, '2025-04-04 18:59:56'),
(2, 'The Dark Knight', '2008', 'Action, Crime', 'The Dark Knight.jpg', 'Batman faces the Joker, a criminal mastermind who creates chaos.', 0.0, 1, '2025-04-04 18:59:56'),
(3, 'Interstellar', '2014', 'Sci-Fi, Adventure', 'Interstellar.jpg', 'Astronauts travel through a wormhole searching for a new home for humanity.', 0.0, 1, '2025-04-04 18:59:56'),
(4, 'Titanic', '1997', 'Romance, Adventure', 'Titanic.jpg', 'A love story set on the doomed ship that sank in 1912.', 0.0, 1, '2025-04-04 18:59:56'),
(5, 'The Matrix', '1999', 'Action, Sci-Fi', 'The Matrix.jpg', 'A hacker discovers the true nature of reality and joins a rebellion.', 0.0, 1, '2025-04-04 18:59:56'),
(6, 'Avatar', '2009', 'Action, Sci-Fi', 'Avatar.jpg', 'A paraplegic marine is sent to Pandora and becomes part of the Na’vi.', 0.0, 1, '2025-04-04 18:59:56'),
(7, 'The Lord of the Rings: The Fellowship of the Ring', '2001', 'Fantasy, Adventure', 'The Lord of the Rings The Fellowship of the Ring.jpg', 'A hobbit embarks on a journey to destroy a powerful ring.', 0.0, 1, '2025-04-04 18:59:56'),
(8, 'The Shawshank Redemption', '1994', 'Thriller,Crime', 'The Shawshank Redemption.jpg', 'A banker is wrongly imprisoned and seeks freedom.', 0.0, 1, '2025-04-04 18:59:56'),
(9, 'Pulp Fiction', '1994', 'Thriller,Crime', 'Pulp Fiction.jpg', 'A series of interconnected crime stories.', 0.0, 1, '2025-04-04 18:59:56'),
(10, 'Forrest Gump', '1994', 'Comedy, Romance', 'Forrest Gump.jpg', 'A man with a low IQ witnesses key historical events.', 0.0, 1, '2025-04-04 18:59:56'),
(11, 'Gladiator', '2000', 'Action, Adventure', 'Gladiator.jpg', 'A betrayed Roman general fights his way back for revenge.', 0.0, 1, '2025-04-04 18:59:56'),
(12, 'The Godfather', '1972', 'Crime', 'The Godfather.jpg', 'A powerful mafia family’s story of power and legacy.', 0.0, 1, '2025-04-04 18:59:56'),
(13, 'Fight Club', '1999', 'Action, Crime', 'Fight Club.jpg', 'An insomniac office worker forms an underground fight club.', 0.0, 1, '2025-04-04 18:59:56'),
(14, 'The Silence of the Lambs', '1991', 'Horror, Crime', 'The Silence of the Lambs.jpg', 'An FBI trainee seeks the help of a cannibalistic serial killer.', 0.0, 1, '2025-04-04 18:59:56'),
(15, 'The Departed', '2006', 'Thriller, Crime', 'The Departed.jpg', 'An undercover cop and a mole in the police struggle to uncover each other.', 0.0, 1, '2025-04-04 18:59:56'),
(16, 'The Prestige', '2006', 'Thriller, Sci-Fi', 'The Prestige.jpg', 'Two rival magicians engage in a dangerous game.', 0.0, 1, '2025-04-04 18:59:56'),
(17, 'The Green Mile', '1999', 'Fantasy, Crime', 'The Green Mile.jpg', 'A death row prison guard meets a miraculous inmate.', 0.0, 1, '2025-04-04 18:59:56'),
(18, 'Schindler’s List', '1993', 'War, Drama', 'Schindlers List.jpg', 'A businessman saves Jews during WWII.', 0.0, 1, '2025-04-04 18:59:56'),
(19, 'The Lion King', '1994', 'Family, Musical', 'The Lion King.jpg', 'A young lion prince flees his kingdom only to return stronger.', 0.0, 1, '2025-04-04 18:59:56'),
(20, 'Joker', '2019', 'Thriller, Crime', 'Joker.jpg', 'A mentally troubled comedian turns into a criminal mastermind.', 0.0, 1, '2025-04-04 18:59:56'),
(21, 'Django Unchained', '2012', 'Western, Action', 'Django Unchained.jpg', 'A freed slave sets out to rescue his wife.', 0.0, 1, '2025-04-04 18:59:56'),
(22, 'The Revenant', '2015', 'Western, Action', 'The Revenant.jpg', 'A frontiersman fights for survival after being left for dead.', 0.0, 1, '2025-04-04 18:59:56'),
(23, 'Braveheart', '1995', 'War, Action', 'Braveheart.jpg', 'A Scottish warrior leads a rebellion against England.', 0.0, 1, '2025-04-04 18:59:56'),
(24, 'Mad Max: Fury Road', '2015', 'Action, Sci-Fi', 'Mad Max Fury Road.jpg', 'A woman rebels against a tyrant in a post-apocalyptic world.', 0.0, 1, '2025-04-04 18:59:56'),
(25, 'The Wolf of Wall Street', '2013', 'Comedy, Thriller', 'The Wolf of Wall Street.jpg', 'The rise and fall of a corrupt stockbroker.', 0.0, 1, '2025-04-04 18:59:56'),
(26, 'The Social Network', '2010', 'Drama, History', 'The Social Network.jpg', 'The story of the founding of Facebook.', 0.0, 1, '2025-04-04 18:59:56'),
(27, 'A Beautiful Mind', '2001', 'Thriller, Romance', 'A Beautiful Mind.jpg', 'A mathematician struggles with schizophrenia.', 0.0, 1, '2025-04-04 18:59:56'),
(28, 'Whiplash', '2014', 'Drama, Musical', 'Whiplash.jpg', 'A young drummer pushes himself to the limit under a ruthless instructor.', 0.0, 1, '2025-04-04 18:59:56'),
(29, 'La La Land', '2016', 'Musical, Romance', 'La La Land.jpg', 'A love story between an aspiring actress and a jazz musician.', 0.0, 1, '2025-04-04 18:59:56'),
(30, 'Parasite', '2019', 'Thriller, Comedy', 'Parasite.jpg', 'A poor family infiltrates a rich household.', 0.0, 1, '2025-04-04 18:59:56'),
(31, 'No Country for Old Men', '2007', 'Thriller, Western', 'No Country for Old Men.jpg', 'A hunter stumbles upon a drug deal gone wrong.', 0.0, 1, '2025-04-04 18:59:56'),
(32, 'The Grand Budapest Hotel', '2014', 'Comedy, Adventure', 'The Grand Budapest Hotel.jpg', 'A concierge and his protégé get caught in a web of intrigue.', 0.0, 1, '2025-04-04 18:59:56'),
(33, 'Shutter Island', '2010', 'Thriller, Mystery', 'Shutter Island.jpg', 'A detective investigates a mysterious disappearance at a mental hospital.', 0.0, 1, '2025-04-04 18:59:56'),
(34, 'A Quiet Place', '2018', 'Horror, Sci-Fi', 'A Quiet Place.jpg', 'A family survives in silence from alien creatures.', 0.0, 1, '2025-04-04 18:59:56'),
(35, 'It', '2017', 'Horror, Mystery', 'It.jpg', 'A group of kids face an ancient evil in their small town.', 0.0, 1, '2025-04-04 18:59:56'),
(36, 'John Wick', '2014', 'Thriller, Action', 'John Wick.jpg', 'A former hitman seeks vengeance after his dog is killed.', 0.0, 1, '2025-04-04 18:59:56'),
(37, 'Logan', '2017', 'Action, Sci-Fi', 'Logan.jpg', 'An aging Wolverine protects a young mutant.', 0.0, 1, '2025-04-04 18:59:56'),
(38, 'Deadpool', '2016', 'Action, Comedy', 'Deadpool.jpg', 'A mercenary with a dark sense of humor seeks revenge.', 0.0, 1, '2025-04-04 18:59:56'),
(39, 'Black Panther', '2018', 'Action, Sci-Fi', 'Black Panther.jpg', 'A young king of Wakanda faces threats to his throne.', 0.0, 1, '2025-04-04 18:59:56'),
(40, 'Avengers: Endgame', '2019', 'Action, Sci-Fi', 'Avengers Endgame.jpg', 'The Avengers assemble to defeat Thanos.', 0.0, 1, '2025-04-04 18:59:56'),
(41, 'Doctor Strange', '2016', 'Action, Fantasy', 'Doctor Strange.jpg', 'A surgeon discovers the mystical arts.', 0.0, 1, '2025-04-04 18:59:56'),
(42, 'The Irishman', '2019', 'Crime, Documentary', 'The Irishman.jpg', 'A hitman reflects on his life in the mafia.', 0.0, 1, '2025-04-04 18:59:56'),
(43, 'The Hateful Eight', '2015', 'Western, Action', 'The Hateful Eight.jpg', 'Eight strangers seek shelter during a blizzard.', 0.0, 1, '2025-04-04 18:59:56'),
(44, 'The Conjuring', '2013', 'Horror, Mystery', 'The Conjuring.jpg', 'A family is haunted by a supernatural entity.', 0.0, 1, '2025-04-04 18:59:56'),
(45, 'Hereditary', '2018', 'Horror, Mystery', 'Hereditary.jpg', 'A family unravels dark secrets after their grandmother’s death.', 0.0, 1, '2025-04-04 18:59:56'),
(46, 'Us', '2019', 'Horror, Mystery', 'Us.jpg', 'A family is terrorized by their doppelgängers.', 0.0, 1, '2025-04-04 18:59:56'),
(47, 'The Exorcist', '1973', 'Horror, Mystery', 'The Exorcist.jpg', 'A mother seeks help for her possessed daughter.', 0.0, 1, '2025-04-04 18:59:56'),
(48, 'The Blair Witch Project', '1999', 'Horror, Mystery', 'The Blair Witch Project.jpg', 'Three students disappear while filming a documentary in the woods.', 0.0, 1, '2025-04-04 18:59:56'),
(51, 'The One', '2001', 'Action, Sci-Fi', 'the_one2.jpg', 'The film, which deals with the concept of multiverses and interdimensional travel, follows Gabriel Yulaw (Jet Li), a rogue agent who travels to parallel realities in order to kill other versions of himself to become a mythical super-being known as \"The One\".', 0.0, 1, '2025-04-27 13:39:52'),
(52, 'Havoc', '2025', 'Action, Crime, Thriller', 'havoc.jpg', 'After a drug deal gone wrong, a bruised detective must fight his way through the criminal underworld to rescue a politician', 0.0, 1, '2025-04-30 11:29:01'),
(53, 'IF', '2024', 'Action, Animation, Comedy', 'IF.jpg', '12-year-old Bea moves into her grandmother Margaret', 0.0, 1, '2025-05-15 15:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_password` (`email`(5),`password`(5)) USING BTREE,
  ADD UNIQUE KEY `username_password` (`username`(5),`password`(5)) USING BTREE;

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `GENRE` (`genre`(25)),
  ADD KEY `YEAR` (`year_released`) USING BTREE,
  ADD KEY `RATINGS` (`rating`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
