<?php
    $DB_DSN = 'mysql: ;host=' . getenv('IP') . '';
    $DB_USER = 'root';
    $DB_PASSWORD = '';

    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

$query = $pdo->prepare("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
$query->execute();
$query = $pdo->prepare("USE `camagru`");
$query->execute();

$query = $pdo->prepare("CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_photo` int(11) NOT NULL,
  `comment` varchar(1561) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;");
$query->execute();

$query = $pdo->prepare("INSERT INTO `comments` (`id`, `id_photo`, `comment`, `date`) VALUES
(45, 521, 'Non', '2016-08-19 13:38:15'),
(46, 522, 'Oui', '2016-08-19 13:38:21');");
$query->execute();

$query = $pdo->prepare("CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` longtext NOT NULL,
  `id_log` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ext` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;");
$query->execute();

$query = $pdo->prepare("CREATE TABLE IF NOT EXISTS `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_photo` int(11) NOT NULL,
  `id_log` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;");
$query->execute();

$query = $pdo->prepare("INSERT INTO `like` (`id`, `id_photo`, `id_log`, `like`, `dislike`) VALUES
(23, 522, 15, 1, 0),
(24, 521, 15, 0, 1);");
$query->execute();

$query = $pdo->prepare("CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` longtext NOT NULL,
  `id_log` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=523 ;");
$query->execute();

$query = $pdo->prepare("INSERT INTO `photos` (`id`, `src`, `id_log`) VALUES
(521, '../images/521.png', 15),
(522, '../images/522.png', 15);");
$query->execute();

$query = $pdo->prepare("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10000) NOT NULL,
  `pwd` varchar(10000) NOT NULL,
  `email` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;");
$query->execute();

$query = $pdo->prepare("INSERT INTO `users` (`id`, `login`, `pwd`, `email`) VALUES
(11, 'valentin', '60d6e50d4372920e70da9f29482a470c232f98b352f9e096053fd66b1625cd01', 'vjarysta@gmail.com'),
(12, 'mbinet', '3a4f36cd893f48ed79b14b24655b947b22901b4174b3fb61827196f150ff499f', 'mbinet@student.42.fr'),
(15, 'nromptea', 'fae8b039d63e3ce5b178d685352f13387c684146eecb667dea1c3924522fd388', 'nromptea@student.42.fr');");
$query->execute();

?>