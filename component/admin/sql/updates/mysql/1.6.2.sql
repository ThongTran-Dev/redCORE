-- -----------------------------------------------------
-- Table `#__redcore_push`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__redcore_push_notification`
(
    `id`         INT(10)     UNSIGNED   NOT NULL    AUTO_INCREMENT,
    `user_id`    INT(11)                NOT NULL                    COMMENT 'ID of user.',
    `device`     ENUM('android','ios')  NOT NULL                    COMMENT 'Type of device',
    `token`      VARCHAR(255)           NOT NULL    DEFAULT ''      COMMENT 'Token string for device',
    PRIMARY KEY (`id`)
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8
    COMMENT='Table  for store token key device which use for Push service';

-- Add redCORE push relation
ALTER TABLE `#__redcore_push_notification` ADD CONSTRAINT `push_user_relation`
    FOREIGN KEY (`user_id`)
    REFERENCES `#__users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
