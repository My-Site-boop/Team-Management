# 🗂️ Team Task Manager (PHP + MySQL)

A simple Task Management Web Application built using **PHP, MySQL, JavaScript, and Bootstrap**.

## 🚀 Features

### 🔐 Authentication
- User Registration & Login
- Session-based authentication
- Logout functionality

### 👥 Role-Based Access
- **Admin**
  - Create Projects
  - Create Tasks
  - Assign tasks to users
  - Update any task status
- **Member**
  - View assigned tasks
    
### 📊 Dashboard
- Total Tasks
- Completed Tasks
- Pending Tasks
- Overdue task highlight

### 📁 Task Management
- Assign tasks using dropdown (user + project)
- Update task status (Pending / In Progress / Completed)
- Real-time UI update (AJAX)

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, Bootstrap, JavaScript (Fetch API)
- **Backend:** PHP
- **Database:** MySQL
- **Server:** XAMPP (Apache)

---

## ⚙️ Setup Instructions

### 1️⃣ Install XAMPP
Download and install:
👉 https://www.apachefriends.org

---

### 2️⃣ Move Project

Place project inside:
C:\xampp\htdocs\p-team-task-manager

---

### 3️⃣ Start Server

Start:
- Apache
- MySQL

---

### 4️⃣ Create Database

Open:
👉 http://localhost/phpmyadmin

Create database: task_manager
---

### 5️⃣ Import Tables

Run this SQL:
----
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    role ENUM('admin','member') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

------
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

-----
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    assigned_to INT,
    project_id INT,
    status ENUM('pending','in_progress','completed') DEFAULT 'pending',
    due_date DATE,
    FOREIGN KEY (assigned_to) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);

## 🚀 Run on the Browser                                                                                         
http://localhost/p-team-task-manager/public/login.php

<img width="1891" height="911" alt="Screenshot 2026-05-10 105739" src="https://github.com/user-attachments/assets/6ce11d1e-c0b5-48c0-b299-8cb2f24d413e" />

<img width="1880" height="913" alt="Screenshot 2026-05-10 105820" src="https://github.com/user-attachments/assets/29155ab3-1f2f-405f-aaac-ae0c2107682f" />

<img width="1883" height="908" alt="Screenshot 2026-05-10 105910" src="https://github.com/user-attachments/assets/acdbc35d-e483-4eef-9fd0-ac997ab4ffef" />






                                                                                                                                                                                     
