INSERT INTO `#__redcore_oauth_scopes` (`scope`) VALUES
  ('site.create'),
  ('site.read'),
  ('site.update'),
  ('site.delete'),
  ('site.documentation'),
  ('site.task'),
  ('administrator.create'),
  ('administrator.read'),
  ('administrator.update'),
  ('administrator.delete'),
  ('administrator.documentation'),
  ('administrator.task');

-- Add redCORE device tokens relation
ALTER TABLE `#__redcore_device_tokens` ADD CONSTRAINT `device_token_user_relation`
      FOREIGN KEY (`user_id`)
      REFERENCES `#__users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
