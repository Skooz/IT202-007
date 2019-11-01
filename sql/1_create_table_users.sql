create table if not exists `Accounts`(
		`id` int auto_increment not null,
		`username` varchar(30) not null unique,
		`pass` varchar(30) not null unique,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
