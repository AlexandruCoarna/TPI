alter database tpi
    character set utf8mb4
    collate utf8mb4_unicode_ci;

create table if not exists student
(
    id           int primary key auto_increment,
    first_name   char(50),
    last_name    char(50),
    phone_number char(11),
    email        char(50),
    country      char(30),
    city         char(30)
);
