# PHP URL Shortener

A premium, secure, and feature-rich URL Shortener application built with a custom PHP MVC framework.

## 🚀 Features
- **User Authentication**: Secure Login & Registration with CSRF protection.
- **Link Management**: Create custom aliases or generate random short slugs.
- **Real-time Analytics**: Individual click tracking with IP and User Agent logging.
- **Premium UI**: Responsive design with light/dark mode support.
- **Dashboard**: Personalized statistics for each user.

---

## 🛠️ Setup Instructions (Windows / Laragon)

To run this project on your local machine, please follow these steps:

### 1. Prerequisites
- **Laragon Full** (Recommended) or **XAMPP**.
- **PHP 8.0+** enabled.
- **MySQL** service running.
- **Apache mod_rewrite** enabled.

### 2. Installation
1.  **Download/Clone** the repository.
2.  Place the `URL_project` folder inside your Laragon `www` directory (usually `C:\laragon\www\URL_project`).
3.  Start Laragon (or Apache/MySQL).

### 3. Database Configuration
1.  Open **HeidiSQL** (or phpMyAdmin) and create a new database named `url_shortener`.
2.  Import the database schema:
    - Right-click your database and run the `urlshortner.sql` file located in the root of the project.
    - (Alternatively, run `schema.sql` to create the structure from scratch).

### 4. Environment Setup
1.  Locate the `.env` file in the root directory.
2.  Ensure the database credentials match your local setup:
    ```env
    DB_HOST=localhost
    DB_NAME=url_shortener
    DB_USER=root
    DB_PASS=
    APP_URL=http://localhost/URL_project/public
    ```
3.  **Important**: If you renamed the project folder, update the `APP_URL` accordingly.

### 5. Access the Application
- Open your browser and navigate to:  
  **`http://localhost/URL_project/public`**

---

## 📂 Project Structure
- `app/`: Application logic (Controllers, Models, and Views).
- `core/`: Custom MVC framework core (Router, Base Controller, DB handling).
- `config/`: Configuration files (Database settings).
- `public/`: Web server document root (Index.php, CSS, and Assets).
- `.htaccess`: URL rewriting rules for clean URLs.

---

## 👨‍💻 Author
**NJINI FAVOUR BEMSIMBOM**

---
> **Note**: This application is specifically configured for Windows/Laragon with the root directory set to `/URL_project/public`.
