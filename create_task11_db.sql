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
values ('admin', 'admin@gmail.com', '$2y$10$rxSXgUhBgGABd/asdmtTiu7FCI4kiVAykzeZQV8U9ptppSHW2zT/.'),
       ('John', 'john@gmail.com', '$2y$10$fGtS1qikdXMdMt02DjksFe2BE8cJN3NkQLKtwAm7Vp88NPTVAa/v2'),
       ('Jane', 'jane@gmail.com', '$2y$10$V4JIbZWUbDLb6COvRxUJqOnvV3.hGIjGrlFJM3gEUftjO5GwhOnAK');
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
