

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `modelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `modelos` (`id`, `nome`, `marca`) VALUES
(1, 'Supra', 'Toyota'),
(2, 'GTR 34', 'Nissan');

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`, `status`) VALUES
(1, 'teste1 editado', 'teste1editado@gmail.com', 'sdvdsvsdvuhuh', '$2y$10$lJRd5AlX0miS1CI8IVrlKOO3bINldDwx.6ss8fyJCecCZUFasd4R2', 0),
(2, 'teste2', 'teste2@gmail.com', 'MatheusEnSR ', '$2y$10$cr8YxEHdUixWxlXPrQSr8ORn00PSQs66MB0GMzmKW8RRGCgzYpMDu', 1);


CREATE TABLE `veiculos` (
  `id` int(10) UNSIGNED NOT NULL,
  `placa` varchar(10) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `ano` int(11) NOT NULL,
  `modelo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `veiculos` (`id`, `placa`, `cor`, `ano`, `modelo_id`) VALUES
(11, 'Q1EAD32R', 'verde', 1996, 2),
(12, 'EG7IYR6I', 'Roxo', 1994, 1),
(13, '', '', 0, 0);

ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `modelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `veiculos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

