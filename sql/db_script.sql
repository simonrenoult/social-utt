SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `social-utt` DEFAULT CHARACTER SET utf8 ;
USE `social-utt` ;

-- -----------------------------------------------------
-- Table `social-utt`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `admin` ENUM('1','0') NULL ,
  `email` VARCHAR(255) NULL ,
  `email_visibility` ENUM('public','friend','private') NULL ,
  `pwd` VARCHAR(45) NOT NULL ,
  `name` VARCHAR(20) NULL ,
  `name_visibility` ENUM('public','friend','private') NULL ,
  `surname` VARCHAR(20) NULL ,
  `surname_visibility` ENUM('public','friend','private') NULL ,
  `sexe` ENUM('M','F') NULL ,
  `sexe_visibility` ENUM('public','friend','private') NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`program`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`program` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `acronym` VARCHAR(45) NULL ,
  `real_name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `title_UNIQUE` (`acronym` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`user_has_program`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`user_has_program` (
  `user_id` INT NOT NULL ,
  `program_id` INT UNSIGNED NOT NULL ,
  `semester` SMALLINT NULL ,
  PRIMARY KEY (`user_id`, `program_id`) ,
  INDEX `fk_user_has_program_program1_idx` (`program_id` ASC) ,
  INDEX `fk_user_has_program_user_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_has_program_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_program_program1`
    FOREIGN KEY (`program_id` )
    REFERENCES `social-utt`.`program` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`relationship`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`relationship` (
  `target` INT NOT NULL ,
  `origin` INT NOT NULL ,
  `relation` ENUM('Know','Friend','Colleague','Crush') NOT NULL ,
  `date` TIMESTAMP NULL ,
  PRIMARY KEY (`target`, `origin`) ,
  INDEX `fk_user_has_user_user2_idx` (`origin` ASC) ,
  INDEX `fk_user_has_user_user1_idx` (`target` ASC) ,
  CONSTRAINT `fk_user_has_user_user1`
    FOREIGN KEY (`target` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_user_user2`
    FOREIGN KEY (`origin` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`skill`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`skill` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`user_has_skill`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`user_has_skill` (
  `user_id` INT NOT NULL ,
  `skill_id` INT NOT NULL ,
  `skill_visibility` ENUM('public','friend','private') NULL ,
  PRIMARY KEY (`user_id`, `skill_id`) ,
  INDEX `fk_user_has_skill_skill1_idx` (`skill_id` ASC) ,
  INDEX `fk_user_has_skill_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_has_skill_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_skill_skill1`
    FOREIGN KEY (`skill_id` )
    REFERENCES `social-utt`.`skill` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`image`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`image` (
  `id` INT NOT NULL ,
  `link` VARCHAR(225) NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `user_id`) ,
  INDEX `fk_image_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_image_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`proximity_score`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`proximity_score` (
  `target` INT NOT NULL ,
  `origin` INT NOT NULL ,
  `value` SMALLINT NULL ,
  PRIMARY KEY (`target`, `origin`) ,
  INDEX `fk_user_has_user1_user2_idx` (`origin` ASC) ,
  INDEX `fk_user_has_user1_user1_idx` (`target` ASC) ,
  CONSTRAINT `fk_user_has_user1_user1`
    FOREIGN KEY (`target` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_user1_user2`
    FOREIGN KEY (`origin` )
    REFERENCES `social-utt`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `social-utt`.`trace`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `social-utt`.`trace` (
  `id` INT NOT NULL ,
  `user_id` SMALLINT NULL ,
  `date` TIMESTAMP NULL ,
  `description` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `social-utt` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
