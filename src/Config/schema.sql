
use sample_db;

CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(255) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    phone_number VARCHAR(15),
    email VARCHAR(255) UNIQUE NOT NULL
);
