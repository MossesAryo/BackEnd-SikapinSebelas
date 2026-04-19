<p align="center">
  <img src="assets/logo.png" alt="Sijuwara Logo" width="180"/>
</p>

<h1 align="center">SIJUWARA</h1>
<p align="center">
  <b>Sistem Jurnal Siswa Aktif</b><br>
  Digital platform for monitoring, recording, and managing student activities in schools.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/status-active-success">
  <img src="https://img.shields.io/badge/version-1.0-blue">
  <img src="https://img.shields.io/badge/license-MIT-green">
</p>

---

## 📖 Overview

**SIJUWARA (Sistem Jurnal Siswa Aktif)** is a digital journal system designed to help schools manage and monitor student activities efficiently.
It centralizes data related to student behavior, attendance-related events, violations, and achievements into a single integrated platform.

This system aims to replace manual recording methods with a **structured, real-time, and transparent system**, making it easier for teachers, administrators, and school management to make decisions based on accurate data.

---

## 🎯 Objectives

* Improve discipline monitoring and student development tracking
* Provide a transparent and accountable reporting system
* Reduce manual administrative workload
* Enable faster communication between departments
* Support data-driven decision making in schools

---

## ✨ Key Features

### 👨‍🎓 Student Activity Journal

* Record daily student activities
* Track behavioral patterns over time
* Centralized student history

### ⚖️ Violation & Appreciation System

* Input student violations (e.g. lateness, absence)
* Record achievements and positive behavior
* Categorized scoring system

### 🔔 Broadcast Information System

* Departments can send validated announcements
* Notifications delivered to users (teachers/students)
* Prevents schedule conflicts through admin validation

### 🧑‍💼 Role-Based Access Control

* **Admin** → validates and manages system data
* **Department Operator** → inputs and sends information
* **Teacher & Student** → view information only

### 📊 Reporting & Monitoring

* Generate reports for evaluation
* Filter by class, department, or category
* Visual tracking of student performance

---

## 🏗️ System Architecture

SIJUWARA is built using a modern web & mobile architecture:

* **Frontend (Web)**: Tailwind CSS + Alpine.js
* **Backend (API)**: PHP (Laravel-based structure)
* **Mobile App**: Flutter (for notification & access)
* **Database**: MySQL

The system follows a **client-server architecture**, where:

* Flutter & Web act as clients
* Laravel API handles business logic
* MySQL stores structured data

---

## ⚙️ Installation Guide

### 1. Clone Repository

```bash
git clone https://github.com/username/sijuwara.git
cd sijuwara
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup

* Create a MySQL database
* Update `.env`:

```
DB_DATABASE=sijuwara
DB_USERNAME=root
DB_PASSWORD=
```

Run migration:

```bash
php artisan migrate
```

### 5. Run Project

```bash
php artisan serve
```

---

## 📂 Project Structure

```
/app            # Core backend logic
/routes         # API & web routes
/resources      # Views & frontend assets
/public         # Public files
/database       # Migrations & seeders
/assets         # Images (logo, etc)
```

---

## 🖼️ Logo Usage

### 📌 Place your logo

Put your logo file inside:

```
/assets/logo.png
```

### 📌 Display in README

Already included at the top:

```html
<img src="assets/logo.png" width="180"/>
```

### 📌 Important Tips

* Use **PNG with transparent background**
* Recommended size: **300x300 px**
* Keep file name simple: `logo.png`

---

## 🔐 Roles & Permissions

| Role                | Access Level             |
| ------------------- | ------------------------ |
| Admin               | Full control, validation |
| Operator Departemen | Input & send information |
| Guru                | View data & reports      |
| Siswa               | View personal info       |

---

## 🚧 Future Improvements

* Mobile push notification optimization
* Data visualization dashboard (charts)
* AI-based behavior analysis (experimental)
* Integration with school attendance systems

---

## 👨‍💻 Author

**Mosses Aryo Bimo**
Software Engineering Student (RPL)
SMKN 11 Bandung

Interested in:

* Software Development
* Backend Engineering
* Ethical Hacking

---

## 📜 License

This project is licensed under the MIT License.

