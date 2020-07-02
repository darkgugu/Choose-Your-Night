-- Mon May 18 08:33:29 2020
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

DROP DATABASE IF EXISTS `CYN` ;

CREATE SCHEMA IF NOT EXISTS `CYN` DEFAULT CHARACTER SET utf8 ;
USE `CYN`;

-- -----------------------------------------------------
-- Table `CYN`.`ecoles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CYN`.`ecoles` ;

CREATE TABLE IF NOT EXISTS `CYN`.`ecoles` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(45) NULL,
  `Adresse` VARCHAR(45) NULL,
  `Numero` VARCHAR(45) NULL,
  `Responsable` VARCHAR(45) NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CYN`.`utilisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CYN`.`utilisateurs` ;

CREATE TABLE IF NOT EXISTS `CYN`.`utilisateurs` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`));


-- -----------------------------------------------------
-- Table `CYN`.`associations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CYN`.`associations` ;

CREATE TABLE IF NOT EXISTS `CYN`.`associations` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(45) NULL,
  `Adresse` VARCHAR(45) NULL,
  `Note` INT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CYN`.`soirees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CYN`.`soirees` ;

CREATE TABLE IF NOT EXISTS `CYN`.`soirees` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(45) NULL,
  `Adresse` VARCHAR(45) NULL,
  `Date` DATETIME NULL,
  `Theme` VARCHAR(45) NULL,
  `Prix` INT NULL,
  `Affiche` VARCHAR(45) NULL,
  `Places` INT NULL,
  `Billeterie` VARCHAR(45) NULL,
  `Lieu_type` ENUM("Bar", "Salle") NULL,
  `DJ` VARCHAR(45) NULL,
  `DJ_lien` VARCHAR(45) NULL,
  `Etat` VARCHAR(45) NULL,
  `Durée` INT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CYN`.`ecoles_has_associations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CYN`.`ecoles_has_associations` ;

CREATE TABLE IF NOT EXISTS `CYN`.`ecoles_has_associations` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `ecoles_ID` INT NOT NULL,
  `associations_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_ecoles_has_associations_ecoles`
    FOREIGN KEY (`ecoles_ID`)
    REFERENCES `CYN`.`ecoles` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ecoles_has_associations_associations1`
    FOREIGN KEY (`associations_ID`)
    REFERENCES `CYN`.`associations` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CYN`.`Organisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CYN`.`Organisateurs` ;

CREATE TABLE IF NOT EXISTS `CYN`.`Organisateurs` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `soirees_ID` INT NOT NULL,
  `ecoles_has_associations_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_soirees_has_ecoles_has_associations_soirees1`
    FOREIGN KEY (`soirees_ID`)
    REFERENCES `CYN`.`soirees` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_soirees_has_ecoles_has_associations_ecoles_has_associations1`
    FOREIGN KEY (`ecoles_has_associations_ID`)
    REFERENCES `CYN`.`ecoles_has_associations` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
