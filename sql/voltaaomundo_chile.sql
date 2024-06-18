-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jun-2024 às 05:07
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `voltaaomundo_chile`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comentarios`
--

CREATE TABLE `tb_comentarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `comentario` text NOT NULL,
  `data_cad` date NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pedente' COMMENT 'Aprovar ou reprovar enviados'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_comentarios`
--

INSERT INTO `tb_comentarios` (`id`, `nome`, `email`, `comentario`, `data_cad`, `status`) VALUES
(3, 'Maria Silva', 'maria.silva@fatec.sp.gov.br', 'Gostei muito do conteúdo do site!', '2024-06-16', 'Aprovado'),
(4, 'Joey Ramones', 'ramones@fatec.sp.gov.br', 'Rock and roll ensina a você como viver.', '2024-06-16', 'Aprovado'),
(5, 'Iago', 'iago732@gmail.com', 'Quem fez esse site merece uma nota 10!', '2024-06-16', 'Aprovado'),
(6, 'Mateus Santos', 'mateus.santos12@fatec.sp.gov.br', 'Parabéns seu site está muito legal!!!!', '2024-06-17', 'Arquivado'),
(8, 'Ana Laura', 'ana.laura@fatec.sp.gov.br', 'Gostaria de ver mais sobre vinhos chilenos!', '2024-06-17', 'Pendente'),
(9, 'Leonardo Almeida', 'leonardo.almeida@fatec.sp.gov.br', 'Ótima paisagens, gostaria de visitar todas!', '2024-06-17', 'Aprovado'),
(10, 'Testador', 'teste32@outlook.com.br', 'Achei a interface um pouco confusa, pode melhorar.', '2024-06-17', 'Arquivado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `nomeCompleto` varchar(40) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `datacad` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`id`, `nomeCompleto`, `usuario`, `telefone`, `senha`, `email`, `datacad`) VALUES
(1, 'Iago de Oliveira Almeida', 'Admin', '199999999', '$2y$10$IsiyXubLLpAmR3xOeg435uOKCF0DPLOOY1/kdd30b64mFiEuH9Lyi', 'iago732@gmail.com', '2024-06-16');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
