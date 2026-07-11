-- Maithil Thal Database Schema
-- For MySQL / Hostinger Deployment

CREATE DATABASE IF NOT EXISTS maithil_thal;
USE maithil_thal;

-- Menu Categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    icon VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menu Items
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    is_veg BOOLEAN DEFAULT TRUE,
    is_popular BOOLEAN DEFAULT FALSE,
    is_chef_special BOOLEAN DEFAULT FALSE,
    spicy_level INT DEFAULT 1,
    availability BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Table Reservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    guests INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    special_request TEXT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT,
    items JSON, -- Stores array of items and quantities
    total_amount DECIMAL(10, 2),
    status ENUM('pending', 'preparing', 'out_for_delivery', 'delivered') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Initial Data
INSERT INTO categories (name) VALUES ('Special Thali'), ('Veg'), ('Non Veg'), ('Snacks'), ('Drinks');

INSERT INTO menu_items (category_id, name, price, description, is_veg, is_popular, is_chef_special) 
VALUES 
(1, 'Traditional Maithili Thali', 450.00, 'Authentic assortment of curries, rice, and Mithila specialties.', TRUE, TRUE, TRUE),
(2, 'Siddharth Thali', 350.00, 'Premium vegetarian meal with seasonal vegetables.', TRUE, FALSE, FALSE),
(3, 'Janakpur Special Fish', 300.00, 'Fresh river fish cooked in authentic mustard sauce.', FALSE, TRUE, TRUE);
