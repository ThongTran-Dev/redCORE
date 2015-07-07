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

-- Add redCORE push relation
ALTER TABLE `#__redcore_push_notification` ADD CONSTRAINT `push_user_relation`
      FOREIGN KEY (`user_id`)
      REFERENCES `#__users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
