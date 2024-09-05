-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Set-2024 às 11:47
-- Versão do servidor: 8.3.0
-- versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tiwmrepo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `CollectionID` int NOT NULL,
  `CollectionName` varchar(45) DEFAULT NULL,
  `CollectionDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CollectionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `collection`
--

INSERT INTO `collection` (`CollectionID`, `CollectionName`, `CollectionDescription`) VALUES
(1, 'Relatório de estagio', 'Relatório desenvolvido no âmbito de conclusão de um estagio.'),
(2, 'Relatório de projeto', 'Relatório desenvolvido no âmbito de conclusão de um projeto escolhido pelo aluno.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `DocumentId` int NOT NULL AUTO_INCREMENT,
  `DocumentTitle` varchar(45) DEFAULT NULL,
  `DocumentWordKey` varchar(45) DEFAULT NULL,
  `PublicationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `DocumentSummary` text,
  `DocumentDescription` text,
  `collection_CollectionID` int DEFAULT NULL,
  `document_access_AccessID` int DEFAULT NULL,
  `document_state_StateID` int DEFAULT NULL,
  `user_account_UserID` int NOT NULL,
  PRIMARY KEY (`DocumentId`),
  KEY `fk_Document_Colecoes1` (`collection_CollectionID`),
  KEY `fk_Document_Document.access1` (`document_access_AccessID`),
  KEY `fk_Document_Document.state` (`document_state_StateID`),
  KEY `fk_Document_userLogin1` (`user_account_UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `document_access`
--

DROP TABLE IF EXISTS `document_access`;
CREATE TABLE IF NOT EXISTS `document_access` (
  `AccessID` int NOT NULL,
  `AccessName` varchar(45) DEFAULT NULL,
  `AccessDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AccessID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `document_access`
--

INSERT INTO `document_access` (`AccessID`, `AccessName`, `AccessDescription`) VALUES
(1, 'Publico', 'Permite acesso publico ao relatório publicado pelo aluno.'),
(2, 'Restrito', 'Permite acesso limitado a utilizador com sessão iniciada ao relatório publicado pelo aluno.'),
(3, 'Fechado', 'Apenas o aluno que efetuou a publicação tem acesso ao relatório.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `document_file`
--

DROP TABLE IF EXISTS `document_file`;
CREATE TABLE IF NOT EXISTS `document_file` (
  `FileID` int NOT NULL,
  `FileName` varchar(100) DEFAULT NULL,
  `FilePath` varchar(255) DEFAULT NULL,
  `FileType` varchar(25) DEFAULT NULL,
  `FileSize` int DEFAULT NULL,
  `UploadDate` datetime DEFAULT NULL,
  PRIMARY KEY (`FileID`),
  UNIQUE KEY `FileID_UNIQUE` (`FileID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `document_state`
--

DROP TABLE IF EXISTS `document_state`;
CREATE TABLE IF NOT EXISTS `document_state` (
  `StateID` int NOT NULL,
  `StateName` varchar(45) DEFAULT NULL,
  `StateDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `document_state`
--

INSERT INTO `document_state` (`StateID`, `StateName`, `StateDescription`) VALUES
(1, 'Aberto', 'Publicação aberta, permite que seja feitas alterações na publicação.'),
(2, 'Fechado', 'Publicação fechada, não é possível ser editada.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `granted_permission`
--

DROP TABLE IF EXISTS `granted_permission`;
CREATE TABLE IF NOT EXISTS `granted_permission` (
  `user_role_RoleId` int NOT NULL,
  `permission_PermissionId` int NOT NULL,
  KEY `fk_granted_permissions_permissions1` (`permission_PermissionId`),
  KEY `fk_granted_permissions_user_roles1` (`user_role_RoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `PermissionId` int NOT NULL,
  `PermissionDescription` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PermissionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_account`
--

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE IF NOT EXISTS `user_account` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserEmail` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `PasswordHash` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `UserCreationDate` datetime DEFAULT NULL,
  `UserDateUpdate` datetime DEFAULT NULL,
  `UserNumber` int DEFAULT NULL,
  `UserFName` varchar(20) DEFAULT NULL,
  `UserLName` varchar(20) DEFAULT NULL,
  `UserBirth` date DEFAULT NULL,
  `user_role_RoleId` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserID`),
  KEY `fk_userLogin_userRoles1` (`user_role_RoleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `RoleId` int NOT NULL,
  `RoleDescription` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `user_role`
--

INSERT INTO `user_role` (`RoleId`, `RoleDescription`) VALUES
(1, 'Aluno'),
(2, 'Docente'),
(10, 'Administrador');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `fk_Document_Colecoes1` FOREIGN KEY (`collection_CollectionID`) REFERENCES `collection` (`CollectionID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Document_Document.access1` FOREIGN KEY (`document_access_AccessID`) REFERENCES `document_access` (`AccessID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Document_Document.state` FOREIGN KEY (`document_state_StateID`) REFERENCES `document_state` (`StateID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Document_userLogin1` FOREIGN KEY (`user_account_UserID`) REFERENCES `user_account` (`UserID`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `document_file`
--
ALTER TABLE `document_file`
  ADD CONSTRAINT `document_documentId` FOREIGN KEY (`FileID`) REFERENCES `document` (`DocumentId`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `granted_permission`
--
ALTER TABLE `granted_permission`
  ADD CONSTRAINT `fk_granted_permissions_permissions1` FOREIGN KEY (`permission_PermissionId`) REFERENCES `permission` (`PermissionId`),
  ADD CONSTRAINT `fk_granted_permissions_user_roles1` FOREIGN KEY (`user_role_RoleId`) REFERENCES `user_role` (`RoleId`);

--
-- Limitadores para a tabela `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `fk_userLogin_userRoles1` FOREIGN KEY (`user_role_RoleId`) REFERENCES `user_role` (`RoleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
