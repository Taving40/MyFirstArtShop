CREATE TABLE `users` (
  `email` varchar(255) UNIQUE PRIMARY KEY NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
)Engine=InnoDB;

CREATE TABLE `products` (
  `id` int UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) UNIQUE NOT NULL,
  `store_id` int NOT NULL,
  `price` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `size` ENUM ('small', 'medium', 'big') NOT NULL,
  `type` ENUM ('painting', 'sculpture', 'craft') NOT NULL
)Engine=InnoDB;

CREATE TABLE `stores` (
  `id` int UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(255) NOT NULL,
  `store_nume` varchar(255) NOT NULL,
  `score` float4 NOT NULL DEFAULT 0,
  `nr_tranzactii` int NOT NULL DEFAULT 0
)Engine=InnoDB;

CREATE TABLE `carts` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
)Engine=InnoDB;

CREATE TABLE `order` (
  `id` int UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `status` ENUM ('in_transit', 'failed', 'succesful') NOT NULL,
  `responsabil_id` int NOT NULL,
)Engine=InnoDB;

CREATE TABLE `order_items` (
  `id` int UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
)Engine=InnoDB;

CREATE TABLE `reviews` (
  `id` int UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `store_id` int NOT NULL
)Engine=InnoDB;

ALTER TABLE `order_items` ADD FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

ALTER TABLE `order_items` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

ALTER TABLE `products` ADD FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

ALTER TABLE `stores` ADD FOREIGN KEY (`admin_email`) REFERENCES `users` (`email`);

ALTER TABLE `carts` ADD FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

ALTER TABLE `carts` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `order` ADD FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

ALTER TABLE `order` ADD FOREIGN KEY (`responsabil_id`) REFERENCES `stores` (`id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);
