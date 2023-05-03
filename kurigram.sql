
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230501202001', '2023-05-01 20:20:13', 360),
('DoctrineMigrations\\Version20230502022007', '2023-05-02 02:20:20', 284);


INSERT INTO `event` (`id`, `description`, `place`, `name`, `end_date`, `start_date`, `imagen`) VALUES
(1, 'Plaza futbolin', 'Catarroja', 'Futbolin', '2023-02-15', '2023-02-25', 'https://cdn.pixabay.com/photo/2018/06/12/20/17/soccer-3471402_640.jpg'),
(2, 'sadfdf', 'cullera', 'Raul Herranz', '2023-05-25', '2023-05-27', '/tmp/phpE5Uluf.jpg');

INSERT INTO `posts` (`id_post`, `id_user`, `created_at`, `likes`, `text`, `is_submitted`, `file`, `title`) VALUES
(1, NULL, '2023-05-20', 0, 'pedri', 1, '/tmp/phpyntztd.jpg', NULL),
(2, NULL, '2023-05-11', 0, 'pedri', 1, '/tmp/phplge3sS.jpg', NULL),
(3, NULL, '2023-05-10', 0, 'pique', 1, '/tmp/phpFVlQQP.jpg', NULL),
(4, NULL, '2023-05-21', 0, 'pedri', 1, '/tmp/phpOI6IOV.jpg', NULL),
(5, NULL, '2023-05-13', 0, '@Raulsahe', 1, '/tmp/phpb2K46x.jpg', NULL),
(6, NULL, '2023-05-06', 0, '@Raulsahe', 1, 'uploads/posts/6.jpg', NULL);

INSERT INTO `user` (`id`, `name`, `email`, `roles`, `password`, `phone`) VALUES
(5, 'root', 'root', '[\"USER\"]', '$2y$13$dn26idZSFYKHMbpV/yPsce2pVXdCeO4XYD8RozSsIqWUg398fY8ja', 567489506),
(6, 'raul', 'raulsahe@protonmail.com', '[\"ADMIN\"]', '$2y$13$QGbFlOQoXs3Rujn2yrKyKOUr5EOfonKD/ecnBfWUKacot.IXHRT/S', 644484075),
(7, 'Paco', 'juanpaco@gmail.com', '[\"USER\"]', '$2y$13$4lQMvNsy9z7esogGaMfHAes6aMhFuFPZGLkP7u5Hh9J82ZN4A/eg6', 659489504),
(8, 'Raul Herranz', 'raulsahe@protonmail.com', '[\"USER\"]', '$2y$13$ijfYJ64YI8.2p3v278kN5enYiC46iguaiz6FZIML0FWg/wqYO6MDi', 644484075),
(9, 'ANTONIO', 'raul.sales@gmail.com', '[\"USER\"]', '$2y$13$/453hz9h83QGdY7gRsmNQuIgsoiKfktILiiDDH2E7zDAzBwccHKyu', 644484075);
