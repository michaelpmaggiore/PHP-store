use mmaggiore;

DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS product;

CREATE TABLE customer (
    id int auto_increment,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    primary key(id)
);

CREATE TABLE product (
    id int auto_increment,
    product_name varchar(255),
    image_name varchar(255),
    price decimal(6,2),
    in_stock int,
    primary key(id)
);

CREATE TABLE orders (
    id int auto_increment,
    product_id int,
    customer_id int,
    quantity int,
    price decimal(6,2),
    tax decimal(6,2),
    donation decimal(4,2),
    timestamp bigint,
    primary key(id)
);

INSERT INTO customer (first_name, last_name, email)
VALUES ("Mickey", "Mouse", "mmouse@mines.edu");

INSERT INTO customer (first_name, last_name, email)
VALUES ("Donald", "Duck", "dduck@mines.edu");

INSERT INTO product (product_name, image_name, price, in_stock)
VALUES ("iPhone XR", "MT4J3.jpg", 1000.99, 0);

INSERT INTO product (product_name, image_name, price, in_stock)
VALUES ("Flip Phone", "istockphoto-92377019-612x612.jpg", 55.34, 10);

INSERT INTO product (product_name, image_name, price, in_stock)
VALUES ("Samsung Galaxy S68", "Galaxy-A03s-blue-1.jpg", 600.04, 3);