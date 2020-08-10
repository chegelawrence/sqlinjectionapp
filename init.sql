-- initialize the DB structure
CREATE USER 'app'@'172.20.0.3' IDENTIFIED BY 'userpassword';
CREATE DATABASE app;
USE app;

CREATE TABLE users(id int(11) NOT NULL AUTO_INCREMENT,username VARCHAR(50) NOT NULL, password_hash VARCHAR(100) NOT NULL,PRIMARY KEY(id));
CREATE TABLE stock(id int(11) NOT NULL AUTO_INCREMENT, product_name VARCHAR(50) NOT NULL, quantity int(11) NOT NULL, price FLOAT NOT NULL,PRIMARY KEY(id));

-- Grant user permissions
GRANT USAGE ON *.* TO 'app'@'172.20.0.3' IDENTIFIED BY 'userpassword';
GRANT SELECT,INSERT,UPDATE,DELETE ON *.* TO 'app'@'172.20.0.3';