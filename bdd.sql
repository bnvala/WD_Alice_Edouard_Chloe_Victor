CREATE DATABASE `PJ_PISCINE`;

USE `PJ_PISCINE`;

CREATE TABLE `BIENS` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(255) NOT NULL,
    `numero_tel` VARCHAR(20),
    `photos` TEXT,
    `description` TEXT,
    `adresse` TEXT
);

CREATE TABLE `CLIENT` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `adresse` TEXT,
    `courriel` VARCHAR(255) NOT NULL UNIQUE,
    `mot_de_passe` VARCHAR(255) NOT NULL,
    `infos_financieres` TEXT
);

CREATE TABLE `ADMIN` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `courriel` VARCHAR(255) NOT NULL UNIQUE,
    `mot_de_passe` VARCHAR(255) NOT NULL
);

CREATE TABLE `AGENT` (
    `id_agent` INT AUTO_INCREMENT PRIMARY KEY,
    `photo` TEXT,
    `bureau` VARCHAR(255),
    `numero_tel` VARCHAR(20),
    `courriel` VARCHAR(255) NOT NULL UNIQUE,
    `specialite` VARCHAR(255),
    `dispos` TEXT,
    `video` TEXT,
    `cv` TEXT,
    `honoraire` DECIMAL(10, 2)
);

CREATE TABLE `INFOS_FINANCIERES` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `courriel_client` VARCHAR(255) NOT NULL,
    `nom` VARCHAR(255),
    `prenom` VARCHAR(255),
    `adresse_ligne_1` VARCHAR(255),
    `adresse_ligne_2` VARCHAR(255),
    `ville` VARCHAR(255),
    `code_postal` VARCHAR(20),
    `pays` VARCHAR(255),
    `numero_tel` VARCHAR(20),
    FOREIGN KEY (`courriel_client`) REFERENCES `CLIENT`(`courriel`)
);

CREATE TABLE `CONSULTATIONS` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `courriel_client` VARCHAR(255) NOT NULL,
    `date` DATE NOT NULL,
    `heure` TIME NOT NULL,
    `id_agent` INT,
    FOREIGN KEY (`courriel_client`) REFERENCES `CLIENT`(`courriel`),
    FOREIGN KEY (`id_agent`) REFERENCES `AGENT`(`id_agent`)
);

CREATE TABLE `RDV` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_agent` INT,
    `courriel_client` VARCHAR(255) NOT NULL,
    `date` DATE NOT NULL,
    `heure` TIME NOT NULL,
    `adresse` TEXT,
    `autres_infos` TEXT,
    `duree` TIME,
    FOREIGN KEY (`id_agent`) REFERENCES `AGENT`(`id_agent`),
    FOREIGN KEY (`courriel_client`) REFERENCES `CLIENT`(`courriel`)
);
