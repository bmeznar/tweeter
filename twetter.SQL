
CREATE TABLE `users`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `username` Varchar(50) NOT NULL,
  `name` Varchar(200) NOT NULL,
  `bio` Text,
  `birthday` Timestamp NULL,
  `avatar` Varchar(200),
  PRIMARY KEY (`id`)
)
;

ALTER TABLE `users` ADD UNIQUE `username` (`username`)
;

CREATE TABLE `posts`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `description` Text,
  `user_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship3` ON `posts` (`user_id`)
;

CREATE TABLE `images`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `url` Varchar(200) NOT NULL,
  `post_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship1` ON `images` (`post_id`)
;

CREATE TABLE `comments`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `text` Text,
  `post_id` Int,
  `user_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship2` ON `comments` (`post_id`)
;

CREATE INDEX `IX_Relationship6` ON `comments` (`user_id`)
;

CREATE TABLE `likes`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `post_id` Int,
  `user_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship4` ON `likes` (`post_id`)
;

CREATE INDEX `IX_Relationship5` ON `likes` (`user_id`)
;

CREATE TABLE `retweet`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `user_id` Int,
  `post_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship7` ON `retweet` (`user_id`)
;

CREATE INDEX `IX_Relationship8` ON `retweet` (`post_id`)
;

CREATE TABLE `messages`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `content` Text NOT NULL,
  PRIMARY KEY (`id`)
)
;

CREATE TABLE `message_user`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `message_id` Int,
  `sender_id` Int,
  `receiver_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship11` ON `message_user` (`message_id`)
;

CREATE INDEX `IX_Relationship12` ON `message_user` (`sender_id`)
;

CREATE INDEX `IX_Relationship13` ON `message_user` (`receiver_id`)
;

CREATE TABLE `pinned`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `user_id` Int,
  `post_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship14` ON `pinned` (`user_id`)
;

CREATE INDEX `IX_Relationship15` ON `pinned` (`post_id`)
;

ALTER TABLE `images` ADD CONSTRAINT `Relationship1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `comments` ADD CONSTRAINT `Relationship2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `posts` ADD CONSTRAINT `Relationship3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `likes` ADD CONSTRAINT `Relationship4` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `likes` ADD CONSTRAINT `Relationship5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `comments` ADD CONSTRAINT `Relationship6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `retweet` ADD CONSTRAINT `Relationship7` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `retweet` ADD CONSTRAINT `Relationship8` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `message_user` ADD CONSTRAINT `Relationship11` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `message_user` ADD CONSTRAINT `Relationship12` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `message_user` ADD CONSTRAINT `Relationship13` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `pinned` ADD CONSTRAINT `Relationship14` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `pinned` ADD CONSTRAINT `Relationship15` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


