

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230504090033', '2023-05-04 09:00:36', 581),
('DoctrineMigrations\\Version20230507015155', '2023-05-07 01:52:09', 589);

INSERT INTO `event` (`id`, `description`, `place`, `name`, `end_date`, `start_date`, `imagen`) VALUES
(4, 'paddle cullera', 'cullera', 'FUTNOL', '2023-06-10', '2023-05-04', '/tmp/phpF9zu34.jpg'),
(5, 'PLAYA', 'cullera', 'WINSURF', '2023-06-09', '2023-05-03', '/tmp/phpgfwvi6.png'),
(6, 'BASKET', 'cullera', 'BASKET', '2023-06-01', '2023-05-03', '/tmp/phpMYqSX5.jpg');

INSERT INTO `posts` (`id_post`, `id_user`, `created_at`, `likes`, `text`, `is_submitted`, `image`, `title`) VALUES
(6, 4, '2023-05-16', 0, 'rau', 1, '3c2c88265ae6370c5354da50487b7a75.png', NULL),
(7, 4, '2023-05-16', 0, 'probando', 1, '87d91aca2ab974bcfc6d91c4a8c6f699.jpg', NULL),
(8, 4, '2023-05-16', 0, 'messi', 1, '3c688fde15b28fddaa4eaaa506c670df.jpg', NULL),
(9, 4, '2023-05-16', 0, 'sprint 3', 1, '0c6b5b839a92d38a6789bbf6373923ee.png', NULL),
(10, 4, '2023-05-16', 0, 'pedri', 1, 'bae7b52670520c920cbfaeb04e715e5c.jpg', NULL),
(11, 4, '2023-05-16', 0, 'messi', 1, '74dbeb8273934b6482f06d6dbf903af1.jpg', NULL),
(12, 4, '2023-05-16', 0, 'pedri', 1, '6e348b2e63a4f616ae97e3036e06afc9.jpg', NULL),
(13, 4, '2023-05-16', 0, 'pedri', 1, '5e38c58e4a845123735b4ba8a9232c31.jpg', NULL);


INSERT INTO `user` (`id`, `name`, `email`, `roles`, `password`, `phone`) VALUES
(4, 'RAUL SALES HERRANZ', 'raulsahe@protonmail.com', '[\"ADMIN\"]', '$2y$13$NuuM8FsgUTmm2UrdaGhehuFXbweqS7/zpb3/AMs/pUR11bdQ5osKK', 644484073),
(14, 'ROSA HERRANZ POYATOS', 'raul.sales@gmail.com', '[\"USER\"]', '$2y$13$GeK9/YVCsFLgkqrwh9WtC.e2jYPxKVirzQgqOxe5lVzDmJFg1tUza', 644484075),
(17, 'ull', 'chiclemascado49@gmail.com', '[\"USER\"]', '$2y$13$HIUwrvXCzSqc5PcQ8WSEaufzonMRtve40mnjtpHaj0QE4eFKlU7ly', 534344534),
(18, 'faas', 'chiclemascado49@gmail.com', '[\"USER\"]', '$2y$13$jJEi.vKvTgQMFtVWtlgFJ.uvoYViTSLzGlwG9PBprvRLu6lCvVpS2', 234345655),
(19, 'fdfsF', 'rsalesherranz@gmail.com', '[\"ADMIN\"]', '$2y$13$quBQl9iGOxrEIuRHw3upR.qzmqXjlfvxHPFoF1LqLbMRfp6UY2srW', 564342354),
(20, 'PEPE', 'chiclemascado49@gmail.com', '[\"USER\"]', '$2y$13$ylUyseuQFF2gwbBLvwoxtewSeMzjRrHAKAbJVwvAP.umrF9Celibe', 214241221);

