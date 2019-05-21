SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `mail_logs`;
CREATE TABLE `mail_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `template_id` int(11) NOT NULL,
  `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  CONSTRAINT `mail_logs_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `mail_templates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `mail_logs` (`id`, `student`, `title`, `template_id`, `sent`) VALUES
(39,	'Priezvisko Meno',	'ddddddddddd',	1,	'2019-05-18 18:50:14'),
(40,	'Priezvisko Meno',	'ddddddddddd',	1,	'2019-05-18 18:50:15');

DROP TABLE IF EXISTS `mail_templates`;
CREATE TABLE `mail_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `template` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `mail_templates` (`id`, `title`, `template`) VALUES
(1,	'Super Šablóna študentov',	'Dobrý deň,\r\n,\r\nna predmete Webové technológie 2 budete mať k dispozícii vlastný virtuálny linux server, ktorý budete\r\npoužívať počas semestra, a na ktorom budete vypracovávať zadania. Prihlasovacie údaje k Vašemu serveru\r\nsu uvedené nižšie.\r\nip adresa: {{VerejnaIP}}\r\nprihlasovacie meno: {{login}}\r\nheslo: {{heslo}}\r\nVaše web stránky budú dostupné na: http:// {{VerejnaIP}}:{{http}}\r\nS pozdravom,\r\n{{sender}}'),
(2,	'Super Šablóna 2',	'Dobrý deň,\r\nna predmete Webové technológie 2 budete mať k dispozícii vlastný virtuálny linux server, ktorý budete\r\npoužívať počas semestra, a na ktorom budete vypracovávať zadania. Prihlasovacie údaje k Vašemu serveru\r\nsu uvedené nižšie.\r\nip adresa: {{verejnaIP}}\r\nprihlasovacie meno: {{login}}\r\nheslo: {{heslo}}\r\nVaše web stránky budú dostupné na: http:// {{verejnaIP}}:{{http}}\r\nS pozdravom,\r\n{{sender}}');
