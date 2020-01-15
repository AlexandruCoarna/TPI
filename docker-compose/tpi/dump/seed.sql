alter database tpi
    character set utf8mb4
    collate utf8mb4_unicode_ci;

create table if not exists student
(
    id                 int primary key auto_increment,
    first_name         varchar(50) not null,
    last_name          varchar(50) not null,
    phone_number       varchar(10) not null unique,
    email              varchar(50) not null unique,
    personal_id_number varchar(20) not null unique
);
