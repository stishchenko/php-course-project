drop database if exists users_board;
create database if not exists users_board;

use users_board;

create table if not exists users
(
    id       int          not null auto_increment,
    name     varchar(255) not null,
    email    varchar(255) not null,
    password varchar(255) not null,
    role     varchar(10)  not null default 'user',
    primary key (id)
);

insert into users (name, email, password)
values ('admin', 'admin@gmail.com', 'admin'),
       ('John', 'john@gmail,com', 'john'),
       ('Jane', 'jane@gmail.com', 'jane');
update users
set role = 'admin'
where name = 'admin';

create table if not exists messages
(
    id      int      not null auto_increment,
    user_id int,
    message text     not null,
    date    datetime not null default now(),
    primary key (id),
    foreign key (user_id) references users (id)
);
