drop database if exists zoo_db;
CREATE DATABASE IF NOT EXISTS `zoo_db`;
USE `zoo_db`;

-- Short description of the database:
-- The tables have relationships Many-To-Many between animals and employees and also between animals and feeds,
-- because an animal can be taken care of by multiple employees or one employee can take care of several animals
-- and animal can eat multiple types of food or several animals can eat one feed.

CREATE TABLE `animals`
(
    `id`       INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`     VARCHAR(255) NOT NULL,
    `species`  VARCHAR(255) NOT NULL,
    `birthday` DATE         NOT NULL,
    `gender`   VARCHAR(10)  NOT NULL
);

CREATE TABLE `employees`
(
    `id`         INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(255) NOT NULL,
    `surname`    VARCHAR(255) NOT NULL,
    `birthday`   DATE         NOT NULL,
    `department` VARCHAR(255),
    `job`        VARCHAR(255) NOT NULL
);

CREATE TABLE `animals_employees`
(
    `id`          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `animal_id`   INT NOT NULL,
    `employee_id` INT NOT NULL,
    foreign key (animal_id) references animals (id),
    foreign key (employee_id) references employees (id)
);

CREATE TABLE `feeds`
(
    `id`              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`            VARCHAR(255) NOT NULL,
    `type`            VARCHAR(255) NOT NULL,
    `manufacturer`    VARCHAR(255) NOT NULL,
    `price`           DOUBLE       NOT NULL,
    `expiration_date` DATE         NOT NULL,
    `unit`            VARCHAR(255) NOT NULL,
    `total_amount`    DOUBLE       NOT NULL
);
CREATE TABLE `feed_schedule`
(
    `id`        INT    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `animal_id` INT    NOT NULL,
    `feed_id`   INT    NOT NULL,
    `portion`   DOUBLE NOT NULL,
    foreign key (animal_id) references animals (id),
    foreign key (feed_id) references feeds (id)
);

-- Simple test data
insert into animals (name, species, birthday, gender)
values ('Buddy', 'Dog', CURRENT_DATE, 'Male'),
       ('Molly', 'Cat', CURRENT_DATE, 'Female');

insert into employees (name, surname, birthday, department, job)
values ('John', 'Doe', CURRENT_DATE, 'Managers', 'Manager class A'),
       ('Jane', 'Doe', CURRENT_DATE, 'Veterinaries', 'Senior Veterinary');

insert into animals_employees (animal_id, employee_id)
values (1, 2),
       (2, 1);

insert into feeds (name, type, manufacturer, price, expiration_date, unit, total_amount)
values ('Dog food', 'Dry food', 'Purina', 10.5, CURRENT_DATE, 'kg', 100),
       ('Cat food', 'Wet food', 'Whiskas', 5.25, CURRENT_DATE, 'kg', 50);

insert into feed_schedule (animal_id, feed_id, portion)
values (1, 1, 0.250),
       (2, 2, 0.150);