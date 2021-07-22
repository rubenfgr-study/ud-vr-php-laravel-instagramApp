CREATE DATABASE IF NOT EXISTS laravel_master;

USE laravel_master;

CREATE TABLE IF NOT EXISTS users (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(20),
    name VARCHAR(100),
    surname VARCHAR(200),
    nick VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    image VARCHAR(255),
    email_verified_at DATETIME,
    remember_token VARCHAR(100),
    created_at DATETIME,
    updated_at DATETIME
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS images (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(255),
    image_path VARCHAR(255),
    description text,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users(id)
 ) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS likes (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(255),
    image_id INT(255),
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS comments (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(255),
    image_id INT(255),
    content TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images(id)
) ENGINE = InnoDB;

