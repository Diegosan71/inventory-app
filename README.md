# Inventory Manager (PHP)

A simple inventory management web application built to demonstrate backend and frontend web development skills.

## Features

* User login system with sessions
* Product management (Create, Read, Update, Delete)
* Stock alert system for low inventory
* Real-time product search
* Clean responsive UI

## Tech Stack

* PHP
* MySQL
* JavaScript
* Bootstrap

## Installation

1. Clone the repository:

git clone https://github.com/Diegosan71/inventory-app.git

2. Import the database:

Create a database in MySQL and run:

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10,2),
    stock INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255)
);

3. Configure database connection:

Edit config/database.php with your MySQL credentials.  
Make sure the PDO connection points to the correct database.

4. Run the project locally:

Place the project inside your local server directory (XAMPP / Laragon / etc).  

Example:

http://localhost/inventory-app/auth/login.php

## Project Structure

inventory-app
├── auth
│   ├── login.php
│   └── logout.php
├── config
│   └── database.php
├── public
│   ├── add_product.php
│   ├── dashboard.php
│   ├── delete_product.php
│   ├── edit_product.php
│   ├── test_db.php
│   ├── css
│   └── js
└── views

Notes:

- All public-facing pages (dashboard, product management) are inside `public/`.
- `auth/` handles login/logout.   

## Usage

1. Go to your login page:

https://inventoryapplication.free.nf/auth/login.php

2. Use the default credentials (after creating a user with hashed password):

- Username: admin  
- Password: 123456

3. Once logged in, access the dashboard:

https://inventoryapplication.free.nf/public/dashboard.php

## Author

Created as a learning project and portfolio piece for junior web developer roles.