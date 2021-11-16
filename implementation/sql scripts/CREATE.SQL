CREATE TABLE `users` (
    email_id VARCHAR(100) NOT NULL PRIMARY KEY,
    password VARCHAR(512) NOT NULL,
    role VARCHAR(10) NOT NULL,
    first_login BOOLEAN NOT NULL
);

CREATE TABLE `orders` (
    order_id INT(15) NOT NULL PRIMARY KEY,
    order_status VARCHAR(50) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    suggestion VARCHAR(500),
    table_number INT(10) NOT NULL
);

CREATE TABLE `food` (
    food_id INT(15) NOT NULL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price FLOAT(10) NOT NULL,
    photo VARCHAR(255),
    description VARCHAR(500) NOT NULL
);

CREATE TABLE `order_mapping` (
    mapping_id INT(15) NOT NULL PRIMARY KEY,
    order_id INT(15) NOT NULL,
    food_id INT(15) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (food_id) REFERENCES food(food_id)
);

CREATE TABLE `ratings` (
    rating_id INT(15) NOT NULL PRIMARY KEY,
    food_id INT(15) NOT NULL,
    rating INT(1) NOT NULL,
    review VARCHAR(255),
    FOREIGN KEY (food_id) REFERENCES food(food_id)
);

CREATE TABLE `logs` (
    log_id INT(15) NOT NULL PRIMARY KEY,
    description VARCHAR(2000) NOT NULL,
    time TIMESTAMP DEFAULT now()
);