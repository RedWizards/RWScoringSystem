-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2017 at 04:07 PM
-- Server version: 5.6.26-log
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scoring`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_participant` (IN `in_team_id` INT(11), IN `in_participant_firstName` VARCHAR(45), IN `in_participant_lastName` VARCHAR(45), IN `in_participant_email` VARCHAR(45), IN `in_participant_contactNo` VARCHAR(45))  BEGIN
	INSERT INTO participants(team_id, participant_firstName, participant_lastName, participant_email, participant_contactNo)
    VALUES(in_team_id, in_participant_firstName, in_participant_lastname, in_participant_email, in_participant_contactNo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_project` (IN `in_team_id` INT, IN `in_event_id` INT, IN `in_project_name` VARCHAR(45), IN `in_project_type` VARCHAR(45), IN `in_short_desc` VARCHAR(160), IN `in_long_desc` VARCHAR(800))  BEGIN
	INSERT INTO project(
        team_id,
        event_id,
        project_name,
        project_type,
        short_desc,
        long_desc
    )
    VALUES(
        in_team_id,
        in_event_id,
        in_project_name,
        in_project_type,
        in_short_desc,
        in_long_desc
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `app_scoresheet` (IN `in_project_id` INT)  BEGIN
	SET @sql = NULL;

	SELECT
		GROUP_CONCAT(DISTINCT
			CONCAT(
				'MAX(IF(criteria_desc = ''', criteria_desc,''', score, NULL)) AS ''', criteria_desc ,"'"
			)
		) INTO @sql
	FROM (
		(SELECT c.criteria_desc
		FROM
			criteria c,
			scores s
		WHERE s.project_id = in_project_id
		AND c.criteria_id = s.criteria_id)
		AS event_criteria
	);
    
	SET @sql = (
		CONCAT('
			SELECT judge_id, judge_name,', @sql ,'
			FROM
				(
					SELECT j.judge_id, j.judge_name, c.criteria_desc, s.score
					FROM
						judge j,
						criteria c,
						scores s
					WHERE
						s.project_id = ', in_project_id ,'
					AND c.criteria_id = s.criteria_id
					AND j.judge_id = s.judge_id
					ORDER BY judge_name, criteria_desc

				) AS raw_scores
			GROUP BY
				judge_id
		')
	);

	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_criteria` (IN `in_event_id` INT(11), IN `in_criteria_desc` VARCHAR(45), IN `in_criteria_weight` INT(11))  BEGIN
	INSERT INTO criteria(event_id, criteria_desc, criteria_weight)
		VALUES(in_event_id, in_criteria_desc, in_criteria_weight);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_event` (IN `in_event_name` VARCHAR(45), IN `in_event_host` VARCHAR(45), IN `in_event_desc` VARCHAR(160))  BEGIN
	INSERT INTO event(event_name, event_host, event_desc, event_date)
		VALUES(in_event_name, in_event_host, in_event_desc, NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_judge` (IN `in_event_id` INT(11), IN `in_judge_name` VARCHAR(45))  BEGIN
	INSERT INTO judge(event_id, judge_name)
		VALUES(in_event_id, in_judge_name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_average_score` (IN `in_team_id` INT)  BEGIN
	SELECT SUM(score)
    FROM scores
    WHERE team_id = in_team_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `give_score` (IN `in_judge_id` INT(11), IN `in_criteria_id` INT(11), IN `in_project_id` INT(11), IN `in_score` INT(11))  BEGIN
	INSERT INTO scores(judge_id, criteria_id, project_id, score)
		VALUES(in_judge_id, in_criteria_id, in_project_id, in_score);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `judge_scoresheet` (IN `in_judge_id` INT)  BEGIN
	SET @sql = NULL;

	SELECT 
    GROUP_CONCAT(DISTINCT CONCAT('MAX(IF(criteria_desc = \'',
                criteria_desc,
                '\', score, NULL)) AS \'',
                criteria_desc,
                '\''))
INTO @sql FROM
    ((SELECT 
        c.criteria_desc
    FROM
        criteria c, judge j, event e
    WHERE
        j.judge_id = in_judge_id
            AND e.event_id = j.event_id
            AND c.event_id = j.event_id) AS event_criteria);
    
	SET @sql = (
		CONCAT('
			SELECT project_id, project_name, team_id, team_name,', @sql ,'
			FROM
				(
					SELECT DISTINCT
						p.project_id,
						p.project_name,
						t.team_id,
						t.team_name,
						c.criteria_desc,
						s.score
					FROM
						scores s,
						criteria c,
						judge j,
						project p,
						team t
					WHERE
						s.judge_id = ', in_judge_id ,'
							AND p.project_id = s.project_id
							AND t.team_id = p.team_id
							AND c.event_id = p.event_id
							AND s.criteria_id = c.criteria_id
					ORDER BY project_id , team_id, criteria_desc
				) AS raw_scores
			GROUP BY
				project_id
		')
	);

	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_team` (IN `in_team_name` VARCHAR(45))  BEGIN
    INSERT INTO team(
        team_name
    )
    VALUES(
        in_team_name
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_criteria` (IN `in_event_id` INT(11))  BEGIN
	SELECT criteria_id, criteria_desc, criteria_weight
    FROM criteria
    WHERE event_id = in_event_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_judges` (IN `in_event_id` INT(11))  BEGIN
	SELECT judge_id, judge_name
    FROM judge
    WHERE event_id = in_event_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_members` (IN `in_team_id` INT(11))  BEGIN
	SELECT participant_id, participant_firstName, participant_lastName, participant_email, participant_contactNo FROM participants
	WHERE team_id = in_team_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_score` (IN `in_project_id` INT)  BEGIN
	SELECT
		c.criteria_desc,
        s.score
	FROM
		scores s, 
		project p,
        event e,
        criteria c
	WHERE s.project_id = in_project_id
			AND p.project_id = s.project_id
            AND e.event_id = p.event_id
            AND c.event_id = p.event_id
            AND s.criteria_id = c.criteria_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_teams` (IN `in_event_id` INT(11))  BEGIN
	SELECT t.team_id, t.team_name, p.project_name, p.project_type, p.short_desc, p.long_desc
    FROM team t,
		project p
    WHERE 
		p.event_id = in_event_id
    AND t.team_id = p.team_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `criteria_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `criteria_desc` varchar(160) DEFAULT NULL,
  `criteria_weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `event_id`, `criteria_desc`, `criteria_weight`) VALUES
(1, 1, 'Scalability and Impact', 25),
(2, 1, 'Execution and Design', 25),
(3, 1, 'Business Model', 25),
(4, 1, 'Project Validation', 25);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(45) DEFAULT NULL,
  `event_host` varchar(45) DEFAULT NULL,
  `event_desc` varchar(800) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_host`, `event_desc`, `event_date`) VALUES
(1, 'U:HAC Ultimate Pitching ', 'Unionbank', NULL, '2017-04-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `judge_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `judge_name` varchar(45) DEFAULT 'Anonymous'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`judge_id`, `event_id`, `judge_name`) VALUES
(1, 1, 'Christian Cimbracruz'),
(2, 1, 'Prince Julius Hari'),
(3, 1, 'Tonichi Paul Dela Cruz'),
(4, 1, 'Red Periabras'),
(5, 1, 'Francis Olivo'),
(6, 1, 'Ariel Conde'),
(7, 1, 'Jedidiah Garcia'),
(8, 1, 'Eadrian Marzan'),
(9, 1, 'Clint Santos'),
(10, 1, 'Jordan Bolinas'),
(11, 1, 'Jem Zubiri'),
(12, 1, 'Ian Briñosa'),
(13, 1, 'Paul Sablan'),
(14, 1, 'Jay Gecarane'),
(15, 1, 'Joshua Castañeda');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `participant_firstName` varchar(45) DEFAULT NULL,
  `participant_lastName` varchar(45) DEFAULT NULL,
  `participant_email` varchar(45) DEFAULT NULL,
  `participant_contactNo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participant_id`, `team_id`, `participant_firstName`, `participant_lastName`, `participant_email`, `participant_contactNo`) VALUES
(1, 1, 'Chris', 'Militante', NULL, NULL),
(2, 1, 'Patrick', 'Woogue', NULL, NULL),
(3, 1, 'Gabriel Andrew', 'Pineda', NULL, NULL),
(4, 3, 'Jelo Nicole', 'Javier', NULL, NULL),
(5, 3, 'Jayson', 'Abilar', NULL, NULL),
(6, 3, 'Carlo', 'Jumagdao', NULL, NULL),
(7, 3, 'John Paul', 'Escala', NULL, NULL),
(8, 3, 'Rafael', 'Desuyo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `project_name` varchar(45) DEFAULT NULL,
  `project_type` varchar(45) DEFAULT NULL,
  `short_desc` varchar(160) DEFAULT NULL,
  `long_desc` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `event_id`, `team_id`, `project_name`, `project_type`, `short_desc`, `long_desc`) VALUES
(1, 1, 1, 'Laurel Eye', 'Web Application', 'An Uber of Tutorials', 'LaurelEye is an web-based platform where people can find other people willing to educate them in a vast array  of topics from academic subjects to arts and crafts.'),
(2, 1, 2, 'Chibot', 'Mobile Application', 'Virtual Reality Listing app for Foreclosed Properties', 'The app focuses on Real Estate and Cars. The app can be deployed via major App stores (Apple App Store, Google Playstore). App also includes a VR walk-through of a Virtual Bank to familiarize customers of the different things you can do in a branch and also to promote the bank''s ongoing promos or marketing campaigns. The property viewer will contain a "dibs/I''m Interested" button that submits the user''s contact info, making it easier for the bank to contact new leads. This can help the bank increase its market reach faster. As for the users, this decreases guess work and logistics by cutting the need to go to the actual site just by experiencing the interactive photo-spheres and real-time 3D spaces that eventually speed up buyers''  decision to buy or not.'),
(3, 1, 3, 'Intern', 'Web and Mobile Application', 'Amobile recording of traffic violations with banking payment. ', 'This app maintains the history of traffic violation records of a certain driver that has a account on the app while also recording the traffic enforcer info who arrested him/her. This app also provides digital banking for the driver that has been arrested. He/she can pay to Unionbank for his violation/s.');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) NOT NULL,
  `judge_id` int(11) DEFAULT NULL,
  `criteria_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `score` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `judge_id`, `criteria_id`, `project_id`, `score`) VALUES
(20, 1, 1, 1, 10),
(21, 1, 2, 1, 15),
(22, 1, 3, 1, 20),
(23, 1, 4, 1, 10),
(24, 2, 1, 1, 10),
(25, 2, 2, 1, 15),
(26, 2, 3, 1, 20),
(27, 2, 4, 1, 10),
(28, 3, 1, 1, 10),
(29, 3, 2, 1, 15),
(30, 3, 3, 1, 20),
(31, 3, 4, 1, 10),
(32, 4, 1, 1, 10),
(33, 4, 2, 1, 15),
(34, 4, 3, 1, 20),
(35, 4, 4, 1, 10),
(36, 5, 1, 1, 10),
(37, 5, 2, 1, 15),
(38, 5, 3, 1, 20),
(39, 5, 4, 1, 10),
(40, 6, 1, 1, 10),
(41, 6, 2, 1, 15),
(42, 6, 3, 1, 20),
(43, 6, 4, 1, 10),
(44, 7, 1, 1, 10),
(45, 7, 2, 1, 15),
(46, 7, 3, 1, 20),
(47, 7, 4, 1, 10),
(48, 8, 1, 1, 10),
(49, 8, 2, 1, 15),
(50, 8, 3, 1, 20),
(51, 8, 4, 1, 10),
(52, 9, 1, 1, 10),
(53, 9, 2, 1, 15),
(54, 9, 3, 1, 20),
(55, 9, 4, 1, 10),
(56, 10, 1, 1, 10),
(57, 10, 2, 1, 15),
(58, 10, 3, 1, 20),
(59, 10, 4, 1, 10),
(60, 11, 1, 1, 10),
(61, 11, 2, 1, 15),
(62, 11, 3, 1, 20),
(63, 11, 4, 1, 10),
(64, 12, 1, 1, 10),
(65, 12, 2, 1, 15),
(66, 12, 3, 1, 20),
(67, 12, 4, 1, 10),
(68, 13, 1, 1, 10),
(69, 13, 2, 1, 15),
(70, 13, 3, 1, 20),
(71, 13, 4, 1, 10),
(72, 14, 1, 1, 10),
(73, 14, 2, 1, 15),
(74, 14, 3, 1, 20),
(75, 14, 4, 1, 10),
(76, 15, 1, 1, 10),
(77, 15, 2, 1, 15),
(78, 15, 3, 1, 20),
(79, 15, 4, 1, 10),
(80, 1, 1, 2, 10),
(81, 1, 2, 2, 15),
(82, 1, 3, 2, 20),
(83, 1, 4, 2, 10),
(84, 2, 1, 2, 10),
(85, 2, 2, 2, 15),
(86, 2, 3, 2, 20),
(87, 2, 4, 2, 10),
(88, 3, 1, 2, 10),
(89, 3, 2, 2, 15),
(90, 3, 3, 2, 20),
(91, 3, 4, 2, 10),
(92, 4, 1, 2, 10),
(93, 4, 2, 2, 15),
(94, 4, 3, 2, 20),
(95, 4, 4, 2, 10),
(96, 5, 1, 2, 10),
(97, 5, 2, 2, 15),
(98, 5, 3, 2, 20),
(99, 5, 4, 2, 10),
(100, 6, 1, 2, 10),
(101, 6, 2, 2, 15),
(102, 6, 3, 2, 20),
(103, 6, 4, 2, 10),
(104, 7, 1, 2, 10),
(105, 7, 2, 2, 15),
(106, 7, 3, 2, 20),
(107, 7, 4, 2, 10),
(108, 8, 1, 2, 10),
(109, 8, 2, 2, 15),
(110, 8, 3, 2, 20),
(111, 8, 4, 2, 10),
(112, 9, 1, 2, 10),
(113, 9, 2, 2, 15),
(114, 9, 3, 2, 20),
(115, 9, 4, 2, 10),
(116, 10, 1, 2, 10),
(117, 10, 2, 2, 15),
(118, 10, 3, 2, 20),
(119, 10, 4, 2, 10),
(120, 11, 1, 2, 10),
(121, 11, 2, 2, 15),
(122, 11, 3, 2, 20),
(123, 11, 4, 2, 10),
(124, 12, 1, 2, 10),
(125, 12, 2, 2, 15),
(126, 12, 3, 2, 20),
(127, 12, 4, 2, 10),
(128, 13, 1, 2, 10),
(129, 13, 2, 2, 15),
(130, 13, 3, 2, 20),
(131, 13, 4, 2, 10),
(132, 14, 1, 2, 10),
(133, 14, 2, 2, 15),
(134, 14, 3, 2, 20),
(135, 14, 4, 2, 10),
(136, 15, 1, 2, 10),
(137, 15, 2, 2, 15),
(138, 15, 3, 2, 20),
(139, 15, 4, 2, 10),
(140, 1, 1, 3, 10),
(141, 1, 2, 3, 15),
(142, 1, 3, 3, 20),
(143, 1, 4, 3, 10),
(144, 2, 1, 3, 10),
(145, 2, 2, 3, 15),
(146, 2, 3, 3, 20),
(147, 2, 4, 3, 10),
(148, 3, 1, 3, 10),
(149, 3, 2, 3, 15),
(150, 3, 3, 3, 20),
(151, 3, 4, 3, 10),
(152, 4, 1, 3, 10),
(153, 4, 2, 3, 15),
(154, 4, 3, 3, 20),
(155, 4, 4, 3, 10),
(156, 5, 1, 3, 10),
(157, 5, 2, 3, 15),
(158, 5, 3, 3, 20),
(159, 5, 4, 3, 10),
(160, 6, 1, 3, 10),
(161, 6, 2, 3, 15),
(162, 6, 3, 3, 20),
(163, 6, 4, 3, 10),
(164, 7, 1, 3, 10),
(165, 7, 2, 3, 15),
(166, 7, 3, 3, 20),
(167, 7, 4, 3, 10),
(168, 8, 1, 3, 10),
(169, 8, 2, 3, 15),
(170, 8, 3, 3, 20),
(171, 8, 4, 3, 10),
(172, 9, 1, 3, 10),
(173, 9, 2, 3, 15),
(174, 9, 3, 3, 20),
(175, 9, 4, 3, 10),
(176, 10, 1, 3, 10),
(177, 10, 2, 3, 15),
(178, 10, 3, 3, 20),
(179, 10, 4, 3, 10),
(180, 11, 1, 3, 10),
(181, 11, 2, 3, 15),
(182, 11, 3, 3, 20),
(183, 11, 4, 3, 10),
(184, 12, 1, 3, 10),
(185, 12, 2, 3, 15),
(186, 12, 3, 3, 20),
(187, 12, 4, 3, 10),
(188, 13, 1, 3, 10),
(189, 13, 2, 3, 15),
(190, 13, 3, 3, 20),
(191, 13, 4, 3, 10),
(192, 14, 1, 3, 10),
(193, 14, 2, 3, 15),
(194, 14, 3, 3, 20),
(195, 14, 4, 3, 10),
(196, 15, 1, 3, 10),
(197, 15, 2, 3, 15),
(198, 15, 3, 3, 20),
(199, 15, 4, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`) VALUES
(1, 'Laurel Eye'),
(2, 'Chibot'),
(3, 'Intern');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `event_idx` (`event_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`judge_id`),
  ADD KEY `event_idx` (`event_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`),
  ADD KEY `participant_team_idx` (`team_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_team_idx` (`team_id`),
  ADD KEY `project_event_idx` (`event_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `scores_judge_idx` (`judge_id`),
  ADD KEY `scores_criteria_idx` (`criteria_id`),
  ADD KEY `scores_project_idx` (`project_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `judge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `criteria_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `judge`
--
ALTER TABLE `judge`
  ADD CONSTRAINT `judge_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participant_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scores_judge` FOREIGN KEY (`judge_id`) REFERENCES `judge` (`judge_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scores_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
