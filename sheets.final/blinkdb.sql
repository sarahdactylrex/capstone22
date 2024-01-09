drop database if exists blinkdb;
create database if not exists blinkdb;
use blinkdb;

create table `users`(
	`id` int unsigned auto_increment,
    `username` nvarchar(255) not null,
    `password` char(60) not null,
	`first_name` nvarchar(255) not null,
    `middle_init` char(1),
    `last_name` nvarchar(255) not null,
    `email` nvarchar(50) not null,
    `phone` nvarchar(10),
    `is_admin` bool default false,
    unique(`username`),
    unique(`email`),
    primary key(`id`)
);

create table `address`(
	`id` int unsigned auto_increment,
	`address_line1` nvarchar(50) not null,
    `address_line2` nvarchar(50),
    `city` nvarchar(50) not null,
    `state` char(2) not null,
    `zip` nvarchar(10) not null,
    `user_id` int unsigned not null,
    foreign key (`user_id`) references `users`(`id`) on delete cascade,
    primary key(`id`)
);

create table `products`(
    `id` int unsigned auto_increment,
    `image_name` nvarchar(100) not null,
    `print_size` nvarchar(10) not null,
    `finish` nvarchar(15) not null,
    `price` decimal(5, 2) not null,
    primary key(`id`)
);
    
create table `orders`(
	`id` int unsigned auto_increment,
    `user_id` int unsigned not null,
    `order_date` datetime default current_timestamp,
    foreign key(`user_id`) references `users`(`id`),
    primary key(`id`)
);

create table `order_item`(
	`id` int unsigned auto_increment,
    `order_id` int unsigned not null,
    `product_id` int unsigned not null,
    `quantity` int not null,
    foreign key(`order_id`) references `orders`(`id`),
    foreign key(`product_id`) references `products`(`id`),
    primary key(`id`)
);

create table `customorder` (
	`id` int unsigned auto_increment,
	`cimage` nvarchar(50) not null,
    `csize` nvarchar(50),
    `cfinish` nvarchar(50) not null,
    `corder_date` datetime default current_timestamp,
    `user_id` int unsigned not null,
    foreign key (`user_id`) references `users`(`id`) on delete cascade,
    primary key(`id`)
);

create table `image` (
	`id` int unsigned auto_increment primary key,
    `filename` nvarchar(255) not null,
    `mimetype` nvarchar(59) not null,
    `imagedata` mediumblob not null,
    `product_id` int unsigned not null,
    foreign key (`product_id`) references `products`(`id`) on delete cascade
    );

insert into `users`(`username`, `password`, `first_name`, `last_name`, `email`, `is_admin`) values
('sevahhs', '$2y$10$VUkU93RquBhB4wGgKp7nveyOqSVXdeiAdUAbUiEaUKoVBbZqtG2i6', 'Sarah', 'Sheets', 'sevahhs@gmail.com', 1),
('aharris', '$2y$10$naBFR1UATLu2BxJcveEjzuCwryYny5phcR9n4puPqpH1A44H0Ca2a', 'a', 'h', 'e@', 1);

-- insert into `address`(`address_line1`, `city`, `state`, `zip`, `user_id`) values
-- ('114 north st', 'columbus', 'oh', '43211', 1);

insert into `products`(`image_name`, `print_size`, `finish`, `price`) values
('bridge', '16 x 20', 'satin', 149.99),
('sunrise', '11 x 14', 'glossy', 35.99),
('beach', '24 x 36', 'metallic', 279.99),
('maple', '16 x 20', 'matte', 229.99),
('skyline', '24 x 36', 'satin', 379.99),
('clingmans', '16 x 20', 'matte', 179.99),
('lily', '18 x 24', 'matte', 289.99);

-- <is gud tek>
-- alter table `users` add column `is_admin` bool default false;
-- update `users` set is_admin = true where id = 1;

-- select * from `users` u join `address` a on u.id = a.user_id;
-- select * from `address` a join `users` u WHERE u.id = a.user_id;
 select * from users;
-- select * from products;
-- select * from address;
-- select * from image;
-- select * from customorder;
-- SELECT * from address a right join users u on a.user_id = u.id;
-- SELECT * from address a join users u on a.user_id;
-- SELECT * from customorder c join users u WHERE c.user_id = u.id;
-- SELECT p.id, p.image_name, p.print_size, p.finish, p.price, i.id as image_id from products p 
-- LEFT JOIN image i ON p.id = i.product_id;
-- SELECT a.id, a.address_line1, a.address_line2, a.city, a.state, a.zip, u.id as user_id from users u
-- LEFT JOIN users ON u.id = a.user_id
-- WHERE u.id = a.user_id;
-- SELECT address.user_id, users.id, users.first_name
-- FROM address, users
-- WHERE address.user_id = users.id;
-- SELECT * FROM [table1] JOIN [table2] ON [table1.primary_key] = [table2.foreign_key];
-- SELECT * FROM users JOIN address ON users.id = address.user_id WHERE users.id = address.user_id;
-- SELECT * FROM address JOIN users WHERE users.id = address.user_id AND users.id = 1;
-- SELECT * FROM address a JOIN users u WHERE a.user_id = u.id AND u.id = 1;
-- SELECT * FROM address WHERE id = $id AND a.user_id = u.id