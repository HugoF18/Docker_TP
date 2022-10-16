CREATE TABLE `post` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_utilisateur` INT,
  `pseudo` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `post`
  ADD KEY `fk_utilisateur` (`id_utilisateur`);


ALTER TABLE `post`
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);