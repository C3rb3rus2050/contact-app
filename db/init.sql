-- Create database if not exists
CREATE DATABASE IF NOT EXISTS message_db;

-- Create app user that can connect from any host in docker network
CREATE USER 'appuser'@'%' IDENTIFIED BY 'apppass';
GRANT ALL PRIVILEGES ON message_db.* TO 'appuser'@'%';
FLUSH PRIVILEGES;

-- Create table
CREATE TABLE IF NOT EXISTS message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    body TEXT NOT NULL,
    priority INT NOT NULL,
    type INT NOT NULL
);
