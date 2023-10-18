INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1,	'Electronics ',	NULL,	NULL,	NULL),
(2,	'Smartphones',	1,	NULL,	NULL),
(3,	'Laptops',	1,	NULL,	NULL),
(4,	'Clothing',	NULL,	NULL,	NULL),
(5,	'Men\'s Clothing',	4,	NULL,	NULL),
(6,	'Women\'s Clothing',	4,	NULL,	NULL);

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2,	'iPhone 13',	'Apple\'s latest smartphone',	799.99,	'ifone13_1697550071.jpg',	'2023-10-17 13:41:11',	'2023-10-17 13:41:11'),
(3,	'Dell XPS 13',	'High-performance laptop',	1299.99,	'dell-xps_1697550144.png',	'2023-10-17 13:42:24',	'2023-10-17 13:42:24'),
(4,	'T-shirt',	'Basic cotton t-shirt',	12.99,	'tshirt_1697550192.jpg',	'2023-10-17 13:43:12',	'2023-10-17 13:43:12'),
(5,	'Dress',	'Elegant evening dress',	120.99,	'dress_1697550285.jpg',	'2023-10-17 13:44:45',	'2023-10-17 13:44:45');