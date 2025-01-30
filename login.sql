-- Create the database
-- CREATE DATABASE login_system;

-- Switch to the database
-- USE login_system;

-- Create the users table
-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(50) NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     role VARCHAR(20) NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- SELECT * FROM users;

-- DELETE FROM users;


CREATE DATABASE pet_adoption;

USE pet_adoption;

CREATE TABLE pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    breed VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    description TEXT,
    image VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE pets
ADD COLUMN is_adopted TINYINT(1) DEFAULT 0; -- '0 = Available, 1 = Adopted'

SELECT * FROM pets;

DELETE FROM pets;

SET sql_safe_updates=0;


-- CREATE DATABASE apply_discount;

-- USE apply_discount;


USE pet_adoption;

CREATE TABLE discounts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    discount INT NOT NULL
);

SELECT * FROM discounts;

DELETE FROM discounts;


-- CREATE DATABASE pets_count;  For this refer to database pet_adoption 

-- USE pets_count;

-- CREATE TABLE pets (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     breed VARCHAR(255) NOT NULL,
--     age INT NOT NULL,
--     image_url VARCHAR(255) NOT NULL,
--     price DECIMAL(10, 2) NOT NULL
-- );

-- SELECT * FROM pets;


-- CREATE DATABASE pets_list;    For this refer to database pet_adoption

-- USE pets_list;

-- CREATE TABLE pets (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     breed VARCHAR(255) NOT NULL,
--     age INT NOT NULL,
--     description TEXT NOT NULL,
--     image VARCHAR(255) NOT NULL,
--     price INT NOT NULL
-- );

-- SELECT * FROM pets;


USE pet_adoption;

CREATE TABLE adopted_pets (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each adoption record
    user_id INT NOT NULL,              -- ID of the user who adopted the pet
    pet_id INT NOT NULL,               -- ID of the adopted pet
    adoption_date DATETIME NOT NULL,   -- Date and time of adoption
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE -- Reference to the pets table
    -- FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- Reference to the users table
);

SELECT * FROM adopted_pets;

DROP TABLE adopted_pets;


-- Login connection
USE pet_adoption;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECT * FROM users;

DELETE FROM users;