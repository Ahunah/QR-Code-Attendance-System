# QR-Code Attendance System

A QR Code–based Digital Attendance System developed as an Android mobile application using Sketchware Pro. The system allows lecturers to generate a QR code for each lecture session, and students mark their attendance by scanning the QR code using their mobile devices.

This project was fully designed and developed by a single developer as an academic project to improve attendance management and reduce manual effort.

## Table of Contents

1. Project Overview
2. Features
3. Tech Stack
4. How It Works
5. Setup & Installation
6. Usage
7. Project Structure
8. Future Enhancements
9. License

---

## 1. Project Overview

Traditional attendance methods such as paper-based sign sheets and roll calls are inefficient and error-prone. This **QR-Code Attendance System** provides a digital solution where attendance is recorded automatically using QR code scanning through an Android application.

The mobile app is built using **Sketchware Pro**, making the system simple, lightweight, and suitable for rapid Android development.

---

## 2. Features

* QR code generation for each lecture session
* Student attendance marking via QR code scanning
* Android application developed using **Sketchware Pro**
* Student registration and login
* Secure attendance storage
* QR code expiration time
* View and download attendance records

---

## 3. Tech Stack

| Layer              | Technology                  |
| ------------------ | --------------------------- |
| Mobile Application | Sketchware Pro (Android)    |
| Logic              | Java (Sketchware Blocks)    |
| Backend            | PHP                         |
| Database           | MySQL                       |
| QR Code            | QR code generator & scanner |
| Server             | Apache (XAMPP)       |

---

## 4. How It Works

1. Lecturer logs into the system and generates a **QR Code** for the lecture.
2. The QR Code is displayed during the lecture.
3. Students open the **Android app** and scan the QR Code.
4. Attendance details (student ID, date, time) are sent to the backend.
5. Attendance is saved and can be viewed by the lecturer/admin.

---

## 5. Setup & Installation

### Prerequisites

* Android device with **Sketchware Pro**
* PHP server (XAMPP / WAMP / LAMP)
* MySQL database
* Internet connection

### Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/Ahunah/QR-Code-Attendance-System.git
   ```

2. Move backend files to your server directory (`htdocs` in XAMPP).

3. Create a MySQL database (e.g., `qr_attendance`).

4. Import the SQL file if provided.

5. Configure database credentials in `config.php`.

6. Open **Sketchware Pro** and import or recreate the Android app using:

   * Activities
   * Components (Request Network, SharedPreferences, Scanner)

7. Build and install the APK on an Android device.

---

## 6. Usage

### Lecturer / Admin

* Login to the system
* Generate QR Code for lecture
* View and download attendance reports

### Student

* Register and login
* Scan QR Code during lecture
* Attendance is marked automatically

---

## 7. Project Structure

```
QR-Code-Attendance-System/
├── android/
│   └── Sketchware Pro project files
├── backend/
│   ├── config.php
│   ├── login.php
│   ├── register.php
│   ├── save_attendance.php
│   ├── student_records.php
│   ├── print_attendance.php
│   └── download_attendance_pdf.php
├── database/
│   └── attendance.sql
└── README.md
```

---

## 8. Future Enhancements

* Geofencing to restrict attendance within lecture area
* Face recognition integration
* Firebase or cloud database
* Lecturer analytics dashboard
* Play Store deployment
