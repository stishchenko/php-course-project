drop database if exists study_board;

create database if not exists study_board;
use study_board;

create table if not exists faculties
(
    id           int          not null auto_increment primary key,
    faculty_name varchar(100) not null,
    dean         varchar(100),
    address      varchar(255) not null,
    phone        varchar(30)  not null
);

create table if not exists subjects
(
    id           int          not null auto_increment primary key,
    subject_name varchar(255) not null
);

create table if not exists students
(
    id           int          not null auto_increment primary key,
    name         varchar(100) not null,
    surname      varchar(100) not null,
    group_number varchar(10)  not null,
    grade        int          not null,
    faculty_id   int          not null,
    foreign key (faculty_id) references faculties (id)
);

create table if not exists marks
(
    id         int not null auto_increment primary key,
    student_id int not null,
    subject_id int not null,
    mark       int not null,
    foreign key (student_id) references students (id),
    foreign key (subject_id) references subjects (id)
);

insert into faculties(faculty_name, dean, address, phone)
values ('Computer Science', 'Neil Ward', 'New York Street A', '+19293228801'),
       ('Mathematics', 'Myra Kane', 'New York Street A', '+19294470472'),
       ('History', 'Ellis Woodard', 'New York Street B', '+19295636518'),
       ('Arts', 'Laverne Drake', 'New York Street B', '+19298229370'),
       ('Languages', 'Eugenia Blackwell', 'New York Street B', '+19295666852');


insert into subjects(subject_name)
values ('Mathematics'),
       ('Physics'),
       ('History'),
       ('Culture'),
       ('Literature'),
       ('English'),
       ('French'),
       ('German'),
       ('Spanish'),
       ('Arts'),
       ('Music'),
       ('Drama'),
       ('Dance'),
       ('Computer Science'),
       ('Cyber Security'),
       ('Algorithms and Data Structures'),
       ('Web Development'),
       ('Software Engineering');

insert into students(name, surname, group_number, grade, faculty_id)
values ('Liam', 'Smith', 'CS-1', 1, 1),
       ('Noah', 'Johnson', 'CS-1', 1, 1),
       ('William', 'Williams', 'CS-1', 2, 1),
       ('James', 'Brown', 'CS-2', 2, 1),
       ('Oliver', 'Jones', 'CS-3', 3, 1),
       ('Benjamin', 'Garcia', 'MS-1', 1, 2),
       ('Elijah', 'Miller', 'MS-2', 2, 2),
       ('Lucas', 'Davis', 'MS-2', 2, 2),
       ('Mason', 'Rodriguez', 'MS-3', 3, 2),
       ('Logan', 'Martinez', 'MS-3', 3, 2),
       ('Emma', 'Wilson', 'H-1', 1, 3),
       ('Olivia', 'Anderson', 'H-1', 1, 3),
       ('Ava', 'Taylor', 'H-2', 2, 3),
       ('Isabella', 'Thomas', 'H-3', 3, 3),
       ('Sophia', 'Hernandez', 'H-3', 3, 3),
       ('Charlotte', 'Moore', 'A-1', 1, 4),
       ('Mia', 'Martin', 'A-1', 1, 4),
       ('Amelia', 'Jackson', 'A-2', 2, 4),
       ('Harper', 'Thompson', 'A-2', 2, 4),
       ('Evelyn', 'White', 'A-3', 3, 4),
       ('Liam', 'Smith', 'L-1', 1, 5),
       ('Noah', 'Johnson', 'L-2', 2, 5),
       ('William', 'Williams', 'L-2', 2, 5),
       ('James', 'Brown', 'L-2', 2, 5),
       ('Oliver', 'Jones', 'L-2', 3, 5);

insert into marks(student_id, subject_id, mark)
values (1, 14, 5),
       (2, 15, 4),
       (3, 16, 5),
       (4, 17, 3),
       (5, 18, 3),
       (6, 1, 5),
       (7, 2, 4),
       (8, 3, 4),
       (9, 6, 4),
       (10, 1, 5),
       (11, 3, 3),
       (12, 4, 3),
       (13, 5, 3),
       (14, 3, 5),
       (15, 4, 5),
       (16, 10, 5),
       (17, 11, 5),
       (18, 12, 5),
       (19, 13, 4),
       (20, 10, 4),
       (21, 6, 3),
       (22, 7, 4),
       (23, 8, 3),
       (24, 9, 3),
       (25, 6, 5),
       (1, 18, 4),
       (2, 17, 5),
       (3, 16, 5),
       (4, 15, 3),
       (5, 14, 3),
       (6, 2, 5),
       (7, 3, 4),
       (8, 6, 4),
       (9, 1, 3),
       (10, 2, 4),
       (11, 4, 5),
       (12, 5, 4),
       (13, 3, 5),
       (14, 4, 3),
       (15, 11, 5),
       (16, 12, 4),
       (17, 13, 4),
       (18, 10, 3),
       (19, 11, 4),
       (20, 12, 5),
       (21, 7, 5),
       (22, 8, 4),
       (23, 9, 4),
       (24, 6, 3),
       (25, 7, 5);
