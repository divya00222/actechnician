-- Orchid Cafe - Database Schema & Seed Data
-- Target: MySQL / MariaDB (Hostinger/cPanel Compatible)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- 1. Table: admins
-- --------------------------------------------------------
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Admin (Password is 'admin123')
INSERT INTO `admins` (`username`, `password`, `email`, `full_name`) VALUES
('admin', '$2y$10$gV2A5q80rl7cc487r9k/o.NqEN5Dk4spU.LopZRd/dvb0lF2Wapxu', 'admin@orchidcafe.com', 'System Administrator');

-- --------------------------------------------------------
-- 2. Table: settings
-- --------------------------------------------------------
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('business_name', 'Orchid Cafe'),
('tagline', 'Authentic Flavors, Modern Dining.'),
('address', 'PF7H+FX7, Lahan Road, Lahan 56500, Nepal'),
('phone', '+977 123 456 789'),
('email', 'info@orchidcafe.com'),
('whatsapp', '+977 123 456 789'),
('opening_hours_text', 'Mon - Thu: 10:00 AM - 10:00 PM, Fri - Sun: 09:00 AM - 11:00 PM'),
('facebook_url', 'https://facebook.com/orchidcafe'),
('instagram_url', 'https://instagram.com/orchidcafe'),
('tiktok_url', ''),
('youtube_url', ''),
('hero_title', 'Authentic Flavors, Modern Dining.'),
('hero_subtitle', 'From our kitchen to your table, experience the heart of Lahan\'s culinary scene. Award-winning Momo, Biryani, and more.'),
('hero_cta_text', 'View Our Menu'),
('hero_cta_link', 'menu.php'),
('footer_about', 'Nestled in the heart of Lahan, Orchid Cafe began with a simple mission: to serve honest, flavorful food in a space that feels like home.'),
('map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3571.213453!2d86.474!3d26.71!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjbCsDQyJzM2LjAiTiA4NsKwMjgWjI0LjAiRQ!5e0!3m2!1sen!2snp!4v1620000000000!5m2!1sen!2snp'),
('site_title', 'Orchid Cafe - Best Restaurant in Lahan'),
('meta_description', 'Experience authentic flavors and modern dining at Orchid Cafe, Lahan\'s premier culinary destination.'),
('established_since', '2015'),
('google_rating', '3.9'),
('reviews_count', '407'),
('logo', ''),
('favicon', '');

-- --------------------------------------------------------
-- 3. Table: opening_hours
-- --------------------------------------------------------
CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day_name` varchar(20) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `is_closed` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `opening_hours` (`day_name`, `open_time`, `close_time`, `is_closed`, `sort_order`) VALUES
('Monday', '10:00:00', '22:00:00', 0, 1),
('Tuesday', '10:00:00', '22:00:00', 0, 2),
('Wednesday', '10:00:00', '22:00:00', 0, 3),
('Thursday', '10:00:00', '22:00:00', 0, 4),
('Friday', '10:00:00', '23:00:00', 0, 5),
('Saturday', '09:00:00', '23:00:00', 0, 6),
('Sunday', '09:00:00', '22:00:00', 0, 7);

-- --------------------------------------------------------
-- 4. Table: menu_categories
-- --------------------------------------------------------
CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menu_categories` (`name`, `description`, `sort_order`) VALUES
('Starters', 'Perfect for sharing', 1),
('Main Course', 'Hearty and delicious meals', 2),
('Beverages', 'Refreshing drinks and spirits', 3);

-- --------------------------------------------------------
-- 5. Table: menu_items
-- --------------------------------------------------------
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_description` text DEFAULT NULL,
  `full_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_veg` tinyint(1) DEFAULT 0,
  `is_chef_special` tinyint(1) DEFAULT 0,
  `is_popular` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk_menu_category` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menu_items` (`category_id`, `name`, `short_description`, `full_description`, `price`, `is_featured`, `is_veg`, `image`) VALUES
(1, 'Steam Chicken Momo', 'Our signature dumplings served with spicy tomato chutney.', 'Classic Nepali steamed dumplings filled with spiced chicken, served with a secret house-made spicy tomato and sesame chutney.', 350.00, 1, 0, 'https://images.unsplash.com/photo-1541696490-8744a5db7f3d?auto=format&fit=crop&q=80&w=800'),
(1, 'Chicken Lollipop', 'Crispy chicken wings tossed in a spicy Indo-Chinese sauce.', 'Crispy fried chicken wings prepared in a traditional lollipop style, tossed in our signature spicy and tangy Indo-Chinese sauce.', 450.00, 1, 0, 'https://images.unsplash.com/photo-1610057099443-fde8c4d50f91?auto=format&fit=crop&q=80&w=800'),
(2, 'Chicken Biryani Rice', 'Fragrant basmati rice cooked with aromatic spices and tender chicken.', 'Long-grain aromatic basmati rice layered with tender marinated chicken, saffron, and house-blended spices, cooked to perfection.', 650.00, 1, 0, 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?auto=format&fit=crop&q=80&w=800');

-- --------------------------------------------------------
-- 6. Table: gallery_images
-- --------------------------------------------------------
CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT 'Interior',
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 7. Table: offers
-- --------------------------------------------------------
CREATE TABLE `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_value` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `offers` (`title`, `description`, `discount_value`, `status`) VALUES
('Happy Hour', 'Enjoy special prices on appetizers and drinks every weekday.', '20% OFF', 'active');

-- --------------------------------------------------------
-- 8. Table: testimonials
-- --------------------------------------------------------
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `rating` int(11) DEFAULT 5,
  `comment` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 9. Table: faqs
-- --------------------------------------------------------
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `faqs` (`question`, `answer`, `sort_order`) VALUES
('Do you offer delivery?', 'Yes, we provide delivery services within Lahan through our local partners.', 1),
('Are reservations mandatory?', 'Reservations are not mandatory but recommended for weekends and large groups.', 2);

-- --------------------------------------------------------
-- 10. Table: reservations
-- --------------------------------------------------------
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `guests` int(11) NOT NULL,
  `occasion` varchar(100) DEFAULT NULL,
  `seating_preference` varchar(50) DEFAULT 'any',
  `special_requests` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 11. Table: event_inquiries
-- --------------------------------------------------------
CREATE TABLE `event_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `guest_count` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `status` enum('pending','reviewed','confirmed','cancelled') DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 12. Table: contact_messages
-- --------------------------------------------------------
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
