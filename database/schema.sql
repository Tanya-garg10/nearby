CREATE DATABASE IF NOT EXISTS nearby_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nearby_db;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('junior', 'senior') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS accommodations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    owner_id INT UNSIGNED NOT NULL,
    title VARCHAR(180) NOT NULL,
    type ENUM('PG', 'Flat', 'Room', 'Hostel') NOT NULL,
    allowed_for ENUM('Male', 'Female', 'Family') NOT NULL,
    monthly_rent INT UNSIGNED NOT NULL,
    location VARCHAR(255) NOT NULL,
    facilities TEXT NULL,
    description TEXT NOT NULL,
    is_verified TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_accommodations_owner FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS contact_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    accommodation_id INT UNSIGNED NOT NULL,
    requester_id INT UNSIGNED NOT NULL,
    message TEXT NULL,
    status ENUM('pending', 'connected', 'declined') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_contact_accommodation FOREIGN KEY (accommodation_id) REFERENCES accommodations(id) ON DELETE CASCADE,
    CONSTRAINT fk_contact_requester FOREIGN KEY (requester_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
