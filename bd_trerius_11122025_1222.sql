-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/01/2026 às 00:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_trerius`
--
CREATE DATABASE IF NOT EXISTS `bd_trerius` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_trerius`;

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `prRemoverdaEquipe`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prRemoverdaEquipe` (`iduser` INT)   BEGIN
	UPDATE `tb_user` SET `id_equipe` = 1 WHERE `tb_user`.`id_user` = iduser;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversation_members`
--

DROP TABLE IF EXISTS `conversation_members`;
CREATE TABLE `conversation_members` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `entrou_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `message_attachments`
--

DROP TABLE IF EXISTS `message_attachments`;
CREATE TABLE `message_attachments` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `url_arquivo` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `tamanho_bytes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `message_reads`
--

DROP TABLE IF EXISTS `message_reads`;
CREATE TABLE `message_reads` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lido_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_conversa`
--

DROP TABLE IF EXISTS `tb_conversa`;
CREATE TABLE `tb_conversa` (
  `id_conversa` int(11) NOT NULL,
  `nm_tipo` enum('privado','grupo') NOT NULL,
  `id_user_criador` int(11) NOT NULL,
  `dt_criado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_conversa`
--

INSERT INTO `tb_conversa` (`id_conversa`, `nm_tipo`, `id_user_criador`, `dt_criado`) VALUES
(0, 'grupo', 0, '2025-11-16 17:27:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_equipe`
--

DROP TABLE IF EXISTS `tb_equipe`;
CREATE TABLE `tb_equipe` (
  `id_equipe` int(11) NOT NULL,
  `nm_equipe` varchar(100) NOT NULL,
  `id_conversa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_equipe`
--

INSERT INTO `tb_equipe` (`id_equipe`, `nm_equipe`, `id_conversa`) VALUES
(1, 'Sem equipe', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_mensagem`
--

DROP TABLE IF EXISTS `tb_mensagem`;
CREATE TABLE `tb_mensagem` (
  `id_mensagem` int(11) NOT NULL,
  `id_conversa` int(11) NOT NULL,
  `id_user_sender` int(11) NOT NULL,
  `ds_conteudo` text NOT NULL,
  `dt_enviado` datetime NOT NULL,
  `bl_deletada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_noticias`
--

DROP TABLE IF EXISTS `tb_noticias`;
CREATE TABLE `tb_noticias` (
  `id_noticia` int(11) NOT NULL,
  `nm_imagem` varchar(250) NOT NULL,
  `nm_titulo` varchar(50) NOT NULL,
  `ds_noticia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `nm_imagem` varchar(150) NOT NULL DEFAULT 'profilePics/user.jpg',
  `nm_email` varchar(50) NOT NULL,
  `nm_senha` varchar(150) NOT NULL,
  `ds_about` text NOT NULL DEFAULT 'Sobre mim',
  `dt_criado` datetime NOT NULL DEFAULT current_timestamp(),
  `dt_ultimologin` date DEFAULT NULL,
  `id_equipe` int(11) NOT NULL DEFAULT 1,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nm_user`, `nm_imagem`, `nm_email`, `nm_senha`, `ds_about`, `dt_criado`, `dt_ultimologin`, `id_equipe`, `isAdmin`) VALUES
(0, 'admin', 'profilePics/calculus.jpg', '', '$2y$10$r8g9lHGFHF8H1FYQi2m15ecFx4QAO2PeGYf8dgQrH3k9U9V.nF8Ue', 'SOU O ADM SUPREMO', '2025-11-16 14:38:49', '2025-11-17', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `conversation_members`
--
ALTER TABLE `conversation_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cm_conversation` (`conversation_id`),
  ADD KEY `fk_cm_user` (`user_id`);

--
-- Índices de tabela `message_attachments`
--
ALTER TABLE `message_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ma_message` (`message_id`);

--
-- Índices de tabela `message_reads`
--
ALTER TABLE `message_reads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mr_message` (`message_id`),
  ADD KEY `fk_mr_user` (`user_id`);

--
-- Índices de tabela `tb_conversa`
--
ALTER TABLE `tb_conversa`
  ADD PRIMARY KEY (`id_conversa`),
  ADD KEY `fk_conversa_user` (`id_user_criador`);

--
-- Índices de tabela `tb_equipe`
--
ALTER TABLE `tb_equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `fk_equipe_conversa` (`id_conversa`);

--
-- Índices de tabela `tb_mensagem`
--
ALTER TABLE `tb_mensagem`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD KEY `fk_mensagem_conversa` (`id_conversa`),
  ADD KEY `fk_mensagem_user` (`id_user_sender`);

--
-- Índices de tabela `tb_noticias`
--
ALTER TABLE `tb_noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nm_user` (`nm_user`),
  ADD KEY `fk_user_equipe` (`id_equipe`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conversation_members`
--
ALTER TABLE `conversation_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `message_attachments`
--
ALTER TABLE `message_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `message_reads`
--
ALTER TABLE `message_reads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_conversa`
--
ALTER TABLE `tb_conversa`
  MODIFY `id_conversa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_equipe`
--
ALTER TABLE `tb_equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_mensagem`
--
ALTER TABLE `tb_mensagem`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_noticias`
--
ALTER TABLE `tb_noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `conversation_members`
--
ALTER TABLE `conversation_members`
  ADD CONSTRAINT `fk_cm_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `tb_conversa` (`id_conversa`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cm_user` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `message_attachments`
--
ALTER TABLE `message_attachments`
  ADD CONSTRAINT `fk_ma_message` FOREIGN KEY (`message_id`) REFERENCES `tb_mensagem` (`id_mensagem`) ON DELETE CASCADE;

--
-- Restrições para tabelas `message_reads`
--
ALTER TABLE `message_reads`
  ADD CONSTRAINT `fk_mr_message` FOREIGN KEY (`message_id`) REFERENCES `tb_mensagem` (`id_mensagem`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mr_user` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tb_conversa`
--
ALTER TABLE `tb_conversa`
  ADD CONSTRAINT `fk_conversa_user` FOREIGN KEY (`id_user_criador`) REFERENCES `tb_user` (`id_user`);

--
-- Restrições para tabelas `tb_equipe`
--
ALTER TABLE `tb_equipe`
  ADD CONSTRAINT `fk_equipe_conversa` FOREIGN KEY (`id_conversa`) REFERENCES `tb_conversa` (`id_conversa`);

--
-- Restrições para tabelas `tb_mensagem`
--
ALTER TABLE `tb_mensagem`
  ADD CONSTRAINT `fk_mensagem_conversa` FOREIGN KEY (`id_conversa`) REFERENCES `tb_conversa` (`id_conversa`),
  ADD CONSTRAINT `fk_mensagem_user` FOREIGN KEY (`id_user_sender`) REFERENCES `tb_user` (`id_user`);

--
-- Restrições para tabelas `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `fk_user_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `tb_equipe` (`id_equipe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
