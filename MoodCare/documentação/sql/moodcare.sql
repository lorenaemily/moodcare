-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29/05/2025 às 13:50
-- Versão do servidor: 8.0.42
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `moodcare`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dicas_autocuidado`
--

DROP TABLE IF EXISTS `dicas_autocuidado`;
CREATE TABLE IF NOT EXISTS `dicas_autocuidado` (
  `id_dica` int NOT NULL AUTO_INCREMENT,
  `dica` varchar(255) DEFAULT NULL,
  `dicas_favoritas` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_dica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dicas_favoritas`
--

DROP TABLE IF EXISTS `dicas_favoritas`;
CREATE TABLE IF NOT EXISTS `dicas_favoritas` (
  `id_dica_favorita` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_dica_favorita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emocoes`
--

DROP TABLE IF EXISTS `emocoes`;
CREATE TABLE IF NOT EXISTS `emocoes` (
  `id_emocao` int NOT NULL,
  `nome_emocao` varchar(255) NOT NULL,
  `registro_emocional` varchar(255) NOT NULL,
  PRIMARY KEY (`id_emocao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `id_historico` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id_usuario_perfil` int NOT NULL AUTO_INCREMENT,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `meta_usuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` int NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`) VALUES
(1, 'teste', 'teste@gmail.com', 123);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dicas_autocuidado`
--
ALTER TABLE `dicas_autocuidado`
  ADD CONSTRAINT `dicas_autocuidado_ibfk_1` FOREIGN KEY (`id_dica`) REFERENCES `historico` (`id_historico`);

--
-- Restrições para tabelas `dicas_favoritas`
--
ALTER TABLE `dicas_favoritas`
  ADD CONSTRAINT `dicas_favoritas_ibfk_1` FOREIGN KEY (`id_dica_favorita`) REFERENCES `dicas_autocuidado` (`id_dica`);

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_historico`) REFERENCES `emocoes` (`id_emocao`),
  ADD CONSTRAINT `historico_ibfk_2` FOREIGN KEY (`id_historico`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD CONSTRAINT `perfil_usuario_ibfk_1` FOREIGN KEY (`id_usuario_perfil`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
