# 23_pdo_crud

A PHP/MySQL CRUD project using PDO, Bootstrap, and a simple REST-style API structure. The app includes a student management interface, category and post API endpoints, and PHP functions for database operations.

## Project Structure

- `index.php` - Main student dashboard and delete handler.
- `create.php` - Student creation page.
- `update.php` - Student update page.
- `api.php` - Demo page that calls the `api/posts/read.php` endpoint using cURL.
- `styles.css` - Custom stylesheet.

Directories:
- `api/`
  - `category/` - Category API endpoints (`create_category.php`, `delete_category.php`, `read_all_categories.php`, `update_category.php`).
  - `posts/` - Post API endpoints (`create.php`, `delete.php`, `read_single.php`, `read.php`, `update.php`).
  - `students/` - Student API endpoints (`create.php`, `delete.php`, `read.php`, `update.php`).
- `configs/` - Database configuration and helper files.
  - `db_config.php` - PDO database connection settings.
- `core/` - Core model classes and initialization.
  - `initialize.php` - Loads app constants, config, and core classes.
  - `student.php`, `post.php`, `category.php` - Model classes.
- `functions/` - PHP functions used by the web UI.
- `includes/` - App configuration include files.
- `initials/` - Shared header/footer and modal partials.

## Requirements

- XAMPP or equivalent Apache/PHP/MySQL environment
- PHP 7.4+ (or compatible PHP version with PDO support)
- MySQL/MariaDB

## Setup

1. Copy the project folder to your web server root.
   - Example for XAMPP: `C:\xampp\htdocs\23_pdo_crud`

2. Start Apache and MySQL from XAMPP Control Panel.

3. Create the database and tables.
   - The app uses `23_pdo_crud` as the main database name in `configs/db_config.php`.
   - If you have an SQL dump, import it into MySQL.
   - If not, create the database and tables manually.

### Database schema example

Run the SQL below in phpMyAdmin or MySQL shell to create the required database and tables:

```sql
CREATE DATABASE IF NOT EXISTS `23_pdo_crud` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `23_pdo_crud`;

CREATE TABLE `students` (
  `student_id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `gender` VARCHAR(20) NOT NULL,
  `birth_date` DATE,
  `grade_level` VARCHAR(10),
  `class_id` INT,
  `address` VARCHAR(255),
  `city` VARCHAR(100),
  `state` INT,
  `zip_code` VARCHAR(20),
  `parent_name` VARCHAR(150),
  `contact_number` VARCHAR(50),
  `enrollment_date` DATE,
  `class_teacher_id` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `classrooms` (
  `class_id` INT AUTO_INCREMENT PRIMARY KEY,
  `class_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `states` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `firstname` VARCHAR(100),
  `lastname` VARCHAR(100),
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT,
  `author` VARCHAR(150),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for required dropdowns and demo content
INSERT INTO `classrooms` (`class_name`) VALUES
  ('Class 1A'),
  ('Class 2B'),
  ('Class 3C');

INSERT INTO `states` (`name`) VALUES
  ('California'),
  ('Texas'),
  ('Florida');

INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) VALUES
  ('Alice', 'Johnson', 'alice@example.com', 'password123'),
  ('Bob', 'Martinez', 'bob@example.com', 'password123'),
  ('Carol', 'Smith', 'carol@example.com', 'password123');

INSERT INTO `categories` (`name`) VALUES
  ('Science'),
  ('Math'),
  ('History');

INSERT INTO `posts` (`category_id`, `title`, `body`, `author`) VALUES
  (1, 'Introduction to Physics', 'Basic concepts of motion and force.', 'Alice Johnson'),
  (2, 'Algebra Basics', 'Variables, expressions, and equations.', 'Bob Martinez'),
  (3, 'World War II Overview', 'History of the major events in WWII.', 'Carol Smith');
```

4. Update database credentials if needed.
   - Open `configs/db_config.php` and adjust:
     - `$db_host`
     - `$db_user`
     - `$db_password`
     - `$db_name`

5. Ensure absolute include paths are correct.
   - Some API files use hard-coded include paths like `/xampp/htdocs/23_pdo_crud/core/initialize.php`.
   - If you move the project to a different location, update the include paths or change them to relative includes.

6. Open the app in your browser.
   - Main UI: `http://localhost/23_pdo_crud/index.php`
   - API example page: `http://localhost/23_pdo_crud/api.php`

## API Endpoints

The project includes basic API routes under `api/`.

### Category API
- `api/category/create_category.php` - Create category via JSON POST
- `api/category/read_all_categories.php` - Read all categories
- `api/category/update_category.php` - Update category
- `api/category/delete_category.php` - Delete category

### Post API
- `api/posts/read.php` - Read all posts
- `api/posts/read_single.php` - Read a single post
- `api/posts/create.php` - Create a post
- `api/posts/update.php` - Update a post
- `api/posts/delete.php` - Delete a post

### Student API
- `api/students/read.php` - Read student data
- `api/students/create.php` - Create student record
- `api/students/update.php` - Update student record
- `api/students/delete.php` - Delete student record

## Notes

- `functions/_create_handle.php` contains student database helper functions used by `index.php`, `create.php`, and `update.php`.
- `core/initialize.php` loads `includes/config.php`, `configs/db_config.php`, and core model files.
- User authentication expects `users.email` and `users.password` columns in the database.
- The current "Remember me" implementation uses browser cookies, not a dedicated `remember_token` column.
- The app currently expects local development paths and default XAMPP credentials.

## Recommended Improvements

- Add a SQL schema or dump file for faster database setup.
- Convert absolute include paths to relative paths for portability.
- Add input validation and better error handling for API endpoints.
- Add authentication for protected operations.

## Quick Start

```bash
# Start XAMPP services
# Place project in htdocs
# Open browser
http://localhost/23_pdo_crud/index.php
```
