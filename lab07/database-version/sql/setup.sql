CREATE DATABASE IF NOT EXISTS user_db;
USE user_db;

CREATE TABLE IF NOT EXISTS users (
    name VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,  -- For storing hashed passwords
    email VARCHAR(100) NOT NULL
);

-- Insert test data with hashed passwords
INSERT INTO users VALUES 
    ('alice', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alice@example.com'),
    ('bob', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bob@example.com'),
    ('charlie', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'charlie@example.com');

-- All test passwords are "password" (hashed)