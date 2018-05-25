--FORGOT PASS
ALTER TABLE `users` ADD `reset_token` TEXT NULL AFTER `profile_pic`;

--SMTP DEFAULT
INSERT INTO `smtp_settings` (`id`, `name`, `host`, `port`, `authentication`, `username`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (NULL, 'SPARK POST', 'smtp.sparkpostmail.com', '587', 'AUTH LOGIN', 'SMTP_Injection', 'b0eca65b838c62d5108251e62c8f744ba74ae615', '1', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');
