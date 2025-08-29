-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS mydb;

-- Use the database
USE mydb;

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    priority INT NOT NULL DEFAULT 2,
    type INT NOT NULL DEFAULT 1,
    terms TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
