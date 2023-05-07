
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230504090033', '2023-05-04 09:00:36', 581),
('DoctrineMigrations\\Version20230507015155', '2023-05-07 01:52:09', 589);


INSERT INTO `event` (`id`, `description`, `place`, `name`, `end_date`, `start_date`, `imagen`) VALUES
(1, 'Plaza futbolin', 'Catarroja', 'Futbolin', '2023-02-15', '2023-02-25', 'https://cdn.pixabay.com/photo/2018/06/12/20/17/soccer-3471402_640.jpg'),
(2, 'sadfdf', 'cullera', 'Raul Herranz', '2023-05-25', '2023-05-27', '/tmp/phpE5Uluf.jpg');


INSERT INTO `follow` (`id`, `followers`, `following`) VALUES
(1, 1, 2);


INSERT INTO `posts` (`id_post`, `id_user`, `created_at`, `likes`, `text`, `is_submitted`, `image`, `title`) VALUES
(2, 2, '2023-05-07', 0, '@raulsales9', 1, 'd258ad5a0c5b2a7a1351d4214b6c864d.jpg', NULL),
(3, 2, '2023-05-07', 0, '@raulsales9', 1, '54899b53ac99121338016a4ed69cafd2.jpg', NULL);

INSERT INTO `user` (`id`, `name`, `email`, `roles`, `password`, `phone`) VALUES
(1, 'Paco', 'example@gmail.com', '[\"USER\"]', '$2y$13$ePKD3OXKDxzr3qX1Xcnp3uMMmCTsAnnzQxwY.y/lLyqDOc7gsu2AG', 659489504),
(2, 'Perico', 'perico@gmail.com', '[\"USER\"]', '$2y$13$inXaun2WXoUay5ycEettfeHDwZSx66sV/hpZA1vQDEpwi.c3qRu5u', 644484075),
(3, 'Paco', 'example@gmail.com', '[\"USER\"]', '$2y$13$HhoeRflM41QBVMStqjS85OBUW8COYizg0qokAAjdr//bUOGbv88Pu', 659489504),
(4, 'RAUL SALES HERRANZ', 'raulsahe@protonmail.com', '[\"ADMIN\"]', '$2y$13$NuuM8FsgUTmm2UrdaGhehuFXbweqS7/zpb3/AMs/pUR11bdQ5osKK', 644484075),
(5, 'jorge', 'ajorges', '[\"USER\"]', '$2y$13$.6OQTQzG0vHjbA4LHXU6FutwNCx7/1BXXfqs..Ef0p3ez6XGMsSAy', 567483904);
