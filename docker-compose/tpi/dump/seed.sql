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

INSERT INTO `student` (`id`, `first_name`, `last_name`, `phone_number`, `email`, `personal_id_number`)
VALUES (3, 'Andreea', 'Codita', '0762570497', 'codita.andreea@gmail.com', '24736838990'),
       (6, 'Alexandru', 'Coarna', '0769889441', 'coarna.alexandru@gmail.com', '1958374635'),
       (7, 'Andrei', 'Sandica', '4782746528', 'andrei.sandica@gmail.com', '3442222222'),
       (8, 'Ionel', 'Lupu', '4837463527', 'ionel.lupu@gmail.com', '7487878878'),
       (9, 'Costache', 'Georgian', '8773573451', 'costache.georgian@yahoo.com', '3338881191991');
