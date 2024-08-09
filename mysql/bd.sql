-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalho_web`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `respondente`
--

CREATE TABLE `respondente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_nasc` date NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `horas_sono_dia` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `novos_emails` varchar(1000) DEFAULT NULL,
  `mudou_senha` tinyint(1) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `desejo_remocao` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `respondente`
--

INSERT INTO `respondente` (`id`, `nome`, `cpf`, `data_nasc`, `peso`, `altura`, `horas_sono_dia`, `email`, `novos_emails`, `mudou_senha`, `senha`, `desejo_remocao`) VALUES
(56, 'Miguel de Oliveira Júnior', '12345678912', '2003-12-30', 65, 1.79, 5, 'migueljr@mail.com', NULL, 1, '12345678', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `respondente`
--
ALTER TABLE `respondente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `respondente`
--
ALTER TABLE `respondente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
