ALTER TABLE  `products_cpu` ADD  `deleted` TINYINT NULL DEFAULT  '0';
ALTER TABLE  `products_tablet` ADD  `deleted` TINYINT NULL DEFAULT  '0';
ALTER TABLE  `products_mobile` ADD  `deleted` TINYINT NULL DEFAULT  '0';
ALTER TABLE  `products_ssd` ADD  `deleted` TINYINT NULL DEFAULT  '0';