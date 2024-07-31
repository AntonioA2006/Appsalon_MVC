-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema appsalon_MVC
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema appsalon_MVC
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `appsalon_MVC` DEFAULT CHARACTER SET utf8 ;
USE `appsalon_MVC` ;

-- -----------------------------------------------------
-- Table `appsalon_MVC`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appsalon_MVC`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(60) NULL,
  `apellido` VARCHAR(60) NULL,
  `email` VARCHAR(30) NULL,
  `telefono` VARCHAR(10) NULL,
  `admin` TINYINT(1) NULL,
  `confirmado` TINYINT(1) NULL,
  `token` VARCHAR(15) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appsalon_MVC`.`citas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appsalon_MVC`.`citas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `hora` TIME NULL,
  `usuarios_id` INT(11) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_citas_usuarios_idx` (`usuarios_id` ASC) VISIBLE,
  CONSTRAINT `fk_citas_usuarios`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `appsalon_MVC`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appsalon_MVC`.`Servicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appsalon_MVC`.`Servicios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(60) NULL,
  `precio` DECIMAL(5,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appsalon_MVC`.`citasservicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appsalon_MVC`.`citasservicios` (
  `citas_id` INT(11) NULL,
  `Servicios_id` INT(11) NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  INDEX `fk_citas_has_Servicios_Servicios1_idx` (`Servicios_id` ASC) VISIBLE,
  INDEX `fk_citas_has_Servicios_citas1_idx` (`citas_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_citas_has_Servicios_citas1`
    FOREIGN KEY (`citas_id`)
    REFERENCES `appsalon_MVC`.`citas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_has_Servicios_Servicios1`
    FOREIGN KEY (`Servicios_id`)
    REFERENCES `appsalon_MVC`.`Servicios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
