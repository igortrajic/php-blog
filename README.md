# Installation Guide 

IdeGas is a lightweight, secure, and modern Content Management System and blogging platform built using vanilla PHP, SQLite, and Tailwind CSS.

## Features

* **Secure Authentication:** User registration, login, logout, and profile management (update details and passwords). Uses secure password hashing.
* **Content Management:** Full Create, Read, Update, and Delete (CRUD) functionality for blog posts.
* **Secure File Uploads:** Robust image upload handling with strict MIME-type validation to prevent malicious file execution.
* **Categories & Filtering:** Organize posts by categories and filter the archive easily.
* **Modern UI/UX:** Fully responsive and clean design powered by Tailwind CSS. Features flash messages for immediate user feedback.
* **Security First:** 
  * CSRF (Cross-Site Request Forgery) protection on all forms.
  * SQL Injection prevention using PDO prepared statements.
  * XSS (Cross-Site Scripting) mitigation via rigorous output escaping (`htmlspecialchars`).
  * Session hijacking mitigation strategies.

## Tech Stack

* **Backend:** PHP
* **Database:** SQLite3 via PDO
* **Frontend:** HTML, Tailwind CSS
* **Architecture:** MVC-inspired pattern separating logic (Controllers/Models) from presentation (Views).

## Installation & Setup

1. **Clone the repository:**
```bash
   git clone https://github.com/igortrajic/php-blog.git
   cd php-blog
```
3. **Initialize the database**
```bash
sqlite3 database/database.db < database/schema.sql
```
2. **Start a local development server:**
```bash
   php -S localhost:8080 -t ./public
```
3. **Access the application:**

    Open your browser and navigate to:
```bash
localhost:8080
```
