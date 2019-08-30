-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema URITeste
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema URITeste
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BancoURI` DEFAULT CHARACTER SET utf8 ;
USE `BancoURI` ;

-- -----------------------------------------------------
-- Table `URITeste`.`Instituicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BancoURI`.`Instituicao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `URITeste`.`Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BancoURI`.`Aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imagem` VARCHAR(45) NULL,
  `nome` VARCHAR(45) NULL,
  `rankGeral` INT NULL,
  `id_Instituicao` INT NOT NULL,
  `dataCadastro` DATE NULL,
  `score` DECIMAL(10,2) NULL,
  `tentados` INT NULL,
  `resolvidos` INT NULL,
  `submissoes` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Aluno_Instituicao_idx` (`id_Instituicao` ASC),
  CONSTRAINT `fk_Aluno_Instituicao`
    FOREIGN KEY (`id_Instituicao`)
    REFERENCES `BancoURI`.`Instituicao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `URITeste`.`Turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BancoURI`.`Turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `URITeste`.`Turma_has_Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BancoURI`.`Turma_has_Aluno` (
  `id_Turma` INT NOT NULL,
  `id_Aluno` INT NOT NULL,
  PRIMARY KEY (`id_Turma`, `id_Aluno`),
  INDEX `fk_Turma_has_Aluno_Aluno1_idx` (`id_Aluno` ASC),
  INDEX `fk_Turma_has_Aluno_Turma1_idx` (`id_Turma` ASC),
  CONSTRAINT `fk_Turma_has_Aluno_Turma1`
    FOREIGN KEY (`id_Turma`)
    REFERENCES `BancoURI`.`Turma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Turma_has_Aluno_Aluno1`
    FOREIGN KEY (`id_Aluno`)
    REFERENCES `BancoURI`.`Aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

select * from aluno;
select * from instituicao;
select * from turma;
select * from turma_has_aluno;

select * from aluno where score between 0 and 500 order by score;
select * from aluno where score between 0 and 1500 order by score and nome like 'rosa%';
select * from aluno where nome like '%rosa%';
use BancoURI;

