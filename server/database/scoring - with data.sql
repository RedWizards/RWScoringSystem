-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2017 at 04:50 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `give_score` (IN `in_judge_id` INT(11), IN `in_criteria_id` INT(11), IN `in_team_id` INT(11), IN `in_score` INT(11))  BEGIN
	INSERT INTO scores(judge_id, criteria_id, team_id, score)
		VALUES(in_judge_id, in_criteria_id, in_team_id, in_score);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_team` (IN `in_event_id` INT(11), IN `in_team_name` VARCHAR(45), IN `in_project_name` VARCHAR(45), IN `in_project_type` VARCHAR(45), IN `in_short_description` VARCHAR(45), IN `in_long_description` VARCHAR(45))  BEGIN
    INSERT INTO team(
		event_id,
        team_name,
        project_name,
        project_type,
        short_description,
        long_description
    )
    VALUES(
		in_event_id,
        in_team_name,
        in_project_name,
        in_project_type,
        in_short_description,
        in_long_description
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
	SELECT * FROM participants
	WHERE team_id = in_team_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_teams` (IN `in_event_id` INT(11))  BEGIN
	SELECT team_id, team_name, project_name, project_type, short_description, long_description
    FROM team
    WHERE event_id = in_event_id;
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
(2, 2, 'Innovation', 25),
(3, 2, 'Technical Difficulty', 25),
(4, 2, 'Business Impact', 25),
(5, 2, 'Demo', 25);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(45) DEFAULT NULL,
  `event_host` varchar(45) DEFAULT NULL,
  `event_desc` varchar(45) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_host`, `event_desc`, `event_date`) VALUES
(1, '0', NULL, '0', '2017-04-19 01:17:53'),
(2, 'Red Wizard OJT', NULL, 'Sample Event', '2017-04-19 01:18:30'),
(3, 'UHAC FINAL PITCHING', 'UNIONBANK', 'UHAC Series Grand Champion', '2017-04-19 12:46:02'),
(4, '', '', '', '2017-04-19 13:07:29');

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
(2, 2, 'Redentor Periabras'),
(4, 2, 'Elaine Cedillo'),
(5, 2, 'Denise Pantig'),
(6, 2, 'Tonichi Dela Cruz');

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
(1, 2, 'Redentor', 'Periabras', 'redperiabras@gmail.com', '09278572198'),
(5, 2, 'Christian', 'Cimbracruz', 'christiancimbra@gmail.com', '09093291283');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) NOT NULL,
  `judge_id` int(11) DEFAULT NULL,
  `criteria_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `score` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `judge_id`, `criteria_id`, `team_id`, `score`) VALUES
(2, 2, 2, 2, 25),
(3, 6, 3, 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `team_name` varchar(45) DEFAULT NULL,
  `project_name` varchar(45) DEFAULT NULL,
  `project_type` varchar(45) DEFAULT NULL,
  `short_description` varchar(45) DEFAULT NULL,
  `long_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `event_id`, `team_name`, `project_name`, `project_type`, `short_description`, `long_description`) VALUES
(2, 2, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'Team Mamba', NULL, NULL, NULL, NULL),
(6, 2, 'WhiteCloak', 'Heat Alert', 'Web App', 'meh hehe', 'meh hehe'),
(8, 2, 'Harambeats', 'Heat Alert', 'Web App', 'meh hehe', 'blah blah');

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
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `scores_judge_idx` (`judge_id`),
  ADD KEY `scores_team_idx` (`team_id`),
  ADD KEY `scores_criteria_idx` (`criteria_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `team_event_idx` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `judge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scores_judge` FOREIGN KEY (`judge_id`) REFERENCES `judge` (`judge_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scores_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
