USE demo;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    name VARCHAR(100)
);

CREATE TABLE students(
    Rollno VARCHAR(10) PRIMARY KEY,
    Sname VARCHAR(50),
    Address VARCHAR(100),
    Email VARCHAR(100)
);

SELECT * FROM users;