DROP DATABASE IF EXISTS pizzeria;
CREATE DATABASE pizzeria;
USE pizzeria;

CREATE TABLE users (
  id int PRIMARY KEY AUTO_INCREMENT,
  username varchar(40) NOT NULL,
  pass varchar(260) NOT NULL,
  email varchar(40) NOT NULL,
  userrole varchar(20) DEFAULT 'user'
);

CREATE TABLE pizzas (
  id int PRIMARY KEY AUTO_INCREMENT,
  pizzaname varchar(40) NOT NULL,
  pizzadescription varchar(400),
  price decimal DEFAULT 0,
  pizzadisabled boolean DEFAULT false
);

CREATE TABLE orders (
  id int PRIMARY KEY AUTO_INCREMENT,
  customer int,
  pizza int,
  orderstatus varchar(20),
  lastchange datetime DEFAULT NOW(),
  FOREIGN KEY (customer) REFERENCES users(id),
  FOREIGN KEY (pizza) REFERENCES pizzas(id)
);

CREATE TABLE order_history (
  id int PRIMARY KEY AUTO_INCREMENT,
  order_id int,
  old_status varchar(20),
  new_status varchar(20),
  change_time datetime DEFAULT NOW(),
  FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE messages (
  id int PRIMARY KEY AUTO_INCREMENT,
  author_id int,
  recipient_id int,
  contents varchar(400),
  message_time datetime DEFAULT NOW()
);

-- admin password: root, ceasar shitfed by 3 letters
INSERT INTO users(username, pass, email, userrole) VALUES ('admin', '$2y$10$xt8npcGpfqZeu3nhZKhN3.mWqeeVtuXvpvChwh/t77YOpcwM.CcQa', '', 'admin');

-- different pizzas
INSERT INTO pizzas(pizzaname, pizzadescription, price) VALUES ('Margherita', 'Ser, Sos', 30);
INSERT INTO pizzas(pizzaname, pizzadescription, price) VALUES ('Hawaii', 'Ser, Sos, Szynka, Ananas', 34);
INSERT INTO pizzas(pizzaname, pizzadescription, price) VALUES ('Capricciosa', 'Ser, Sos, Szynka, Pieczarki', 38);
INSERT INTO pizzas(pizzaname, pizzadescription, price) VALUES ('Salami', 'Ser, Sos, Salami, Papryka', 32);