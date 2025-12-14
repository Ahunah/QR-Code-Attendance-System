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

### Lecturer / Admin UI
<img width="762" height="631" alt="login" src="https://github.com/user-attachments/assets/41b5e402-9f95-4a74-bf4e-74471c90d073" />
<img width="977" height="781" alt="register" src="https://github.com/user-attachments/assets/95ffa167-a386-432e-b030-a1eaaeb4f11e" />
<img width="1695" height="1023" alt="lect qr" src="https://github.com/user-attachments/assets/92743281-a9ce-4b9b-8ecb-c5d38fa8881d" />
<img width="1455" height="817" alt="qr visible" src="https://github.com/user-attachments/assets/cc914bdd-cd52-45dd-ba77-9198b40bb627" />
<img width="1532" height="715" alt="time over qr not visible" src="https://github.com/user-attachments/assets/c01fdf55-2386-4c30-9360-f599656c876e" />
<img width="1737" height="546" alt="student records" src="https://github.com/user-attachments/assets/67d8fdfc-c296-4f65-83a8-e8a5fb83b65a" />
<img width="1500" height="922" alt="down report" src="https://github.com/user-attachments/assets/2fb9d7bf-b7a5-4f7e-9a00-5cc618b79e83" />
<img width="990" height="403" alt="report" src="https://github.com/user-attachments/assets/63840d7f-1a18-4088-befa-08a8cb33b0aa" />

### Student

* Register and login
* Scan QR Code during lecture
* Attendance is marked automatically

### Screenshot of Student UI

![IMG-20250903-WA0032](https://github.com/user-attachments/assets/c6b05803-9295-4e86-81fc-613c805475da)
![IMG-20250903-WA0032 (3)](https://github.com/user-attachments/assets/085bbeeb-ed90-41f3-874e-fda4765d1ab6)
![IMG-20250903-WA0032 (3)](https://github.com/user-attachments/assets/ad09ba6d-8dac-447c-9837-d0066b3588c8)
![IMG-20250903-WA0032 (4)](https://github.com/user-attachments/assets/af710f2c-5a2c-4d68-9850-e1ee6a101319)
![IMG-20250903-WA0032 (5)](https://github.com/user-attachments/assets/d3e330f7-353e-4135-9eea-581d34d407ef)
![IMG-20250903-WA0032 (6)](https://github.com/user-attachments/assets/8267ed18-e8c4-40f2-ba4b-0f9cea883a31)


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
