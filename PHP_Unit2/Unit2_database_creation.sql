use mmaggiore;

DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS product;

CREATE TABLE customer (
    id int,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255)
);

CREATE TABLE product (
    id int,
    product_name varchar(255),
    image_name varchar(255),
    price decimal(6,2),
    in_stock int 
);

CREATE TABLE orders (
    id int,
    product_id int,
    customer_id int,
    quantity int,
    price decimal(6,2),
    tax decimal(6,2),
    donation decimal(4,2),
    timestamp bigint
);

INSERT INTO customer (id, first_name, last_name, email)
VALUES (1, "Micky", "Mouse", "mmouse@mines.edu");

INSERT INTO customer (id, first_name, last_name, email)
VALUES (2, "Donald", "Duck", "dduck@mines.edu");

INSERT INTO product (id, product_name, image_name, price, in_stock)
VALUES (1, "iPhone XR", "MT4J3.jpg", 1000.99, 0);

INSERT INTO product (id, product_name, image_name, price, in_stock)
VALUES (2, "Flip Phone", "istockphoto-92377019-612x612.jpg", 55.34, 10);

INSERT INTO product (id, product_name, image_name, price, in_stock)
VALUES (3, "Samsung Galaxy S68", "Galaxy-A03s-blue-1.jpg", 600.04, 3);