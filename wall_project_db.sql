-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2013 at 01:15 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wall_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_messages1_idx` (`message_id`),
  KEY `fk_comments_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `created_at`, `updated_at`, `message_id`, `user_id`) VALUES
(23, 'This will take a while.', '2013-08-15 15:56:21', NULL, 39, 1),
(30, 'Blah.', '2013-08-15 16:11:50', NULL, 42, 1),
(31, 'New post!', '2013-08-15 16:12:00', NULL, 42, 1),
(32, 'Is this too long to comment?', '2013-08-15 16:12:06', NULL, 42, 1),
(33, 'Is it a comma,', '2013-08-15 16:12:20', NULL, 42, 1),
(34, 'How long is too long for this format?', '2013-08-15 16:12:29', NULL, 42, 1),
(35, 'Mag, this is a long post to test the comment function.', '2013-08-15 16:13:11', NULL, 43, 2),
(36, 'Maybe it was the dash-', '2013-08-15 16:13:22', NULL, 43, 2),
(37, 'Or the double dash--', '2013-08-15 16:13:29', NULL, 43, 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `created_at`, `updated_at`, `user_id`) VALUES
(39, 'I am repopulating this page with posts.', '2013-08-15 15:56:12', NULL, 1),
(42, 'Why is it ALWAYS sunny in California?', '2013-08-15 16:11:08', NULL, 2),
(43, 'Will all of this post if I write for a little while?', '2013-08-15 16:12:49', NULL, 1),
(44, 'The brown cow, or something.', '2013-08-15 16:13:45', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(2555) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Maggie', 'Epps', 'mepps@rainyday.com', '0853f0d68ce3c9b240969e95082eeac3', '2013-08-14 16:02:37', NULL),
(2, 'Grace', 'Nielson', 'grace@bestfriend.com', '0853f0d68ce3c9b240969e95082eeac3', '2013-08-14 18:43:02', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_messages1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
