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
  - Update only their task status

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

---### 📁 Project Structure
p-team-task-manager/
│
├── config/
│ └── db.php
│
├── api/
│ ├── auth.php
│ ├── task.php
│ ├── project.php
│ └── logout.php
│
├── includes/
│ ├── auth_check.php
│ └── functions.php
│
├── public/
│ ├── index.php
│ ├── dashboard.php
│ ├── login.php
│ └── register.php
│
├── assets/
│ ├── css/style.css
│ └── js/script.js
│
└── README.md

