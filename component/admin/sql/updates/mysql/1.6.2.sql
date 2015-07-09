-- -----------------------------------------------------
-- Table `#__redcore_device_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__redcore_device_tokens`
(
    `id`                INT(10)     UNSIGNED    NOT NULL    AUTO_INCREMENT,
    `user_id`           INT(11)                 NOT NULL                    COMMENT 'ID of user.',
    `device`            ENUM('android','ios')   NOT NULL                    COMMENT 'Type of device',
    `token`             VARCHAR(255)            NOT NULL    DEFAULT ''      COMMENT 'Token string for device',
    `state`             TINYINT(1)              NOT NULL    DEFAULT '1',
    `checked_out`       INT(11)                 NULL        DEFAULT NULL,
    `checked_out_time`  DATETIME                NOT NULL    DEFAULT '0000-00-00 00:00:00',
    `created_by`        INT(11)                 NULL        DEFAULT NULL,
    `created_date`      DATETIME                NOT NULL    DEFAULT '0000-00-00 00:00:00',
    `modified_by`       INT(11)                 NULL        DEFAULT NULL,
    `modified_date`     DATETIME                NOT NULL    DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8
    COMMENT='Table  for store token key device which use for Push service';

-- Add redCORE device tokens relation
ALTER TABLE `#__redcore_device_tokens` ADD CONSTRAINT `device_token_user_relation`
      FOREIGN KEY (`user_id`)
      REFERENCES `#__users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
