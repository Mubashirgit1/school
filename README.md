# School Management System

A web-based School Management System built on **CodeIgniter 3 (PHP 7.4)**. It provides role-based portals for administrators, teachers, parents/students, accountants, and librarians, plus a REST-style API for a companion mobile app.

## Tech Stack

- **Framework:** CodeIgniter 3.1.13 (MVC)
- **Language:** PHP 7.4
- **Database:** MySQL (driver: `mysqli`)
- **Frontend:** Bootstrap-based admin theme, jQuery, CKEditor, Select2, SweetAlert/Toast alerts, custom JS plugins (see `backend/`)

## Project Structure

```
school/
├── application/
│   ├── controllers/
│   │   ├── admin/        # Admin portal (users, fees, exams, inventory, transport, etc.)
│   │   ├── teacher/       # Teacher portal
│   │   ├── parent/        # Parent/student portal
│   │   ├── accountant/   # Accounting & fee management
│   │   ├── librarian/    # Library management
│   │   ├── user/          # Student/general user area
│   │   ├── api/           # API endpoints (Authenticate, Student, Teacher, Staff, ClassApi, Option)
│   │   └── ajax/          # AJAX-only endpoints
│   ├── models/            # ~70 models (Student, Fee, Exam, Hostel, Library, Transport, Payroll, etc.)
│   ├── views/              # View templates per role/module
│   ├── config/             # App config, database, routes, autoload
│   └── migrations/         # DB migrations
├── backend/                # Static assets for the admin theme (CSS/JS/plugins/images)
├── login/                  # Login page assets
├── apis/                   # Legacy/standalone PHP API scripts (conn.php, login.php, student_*.php, etc.)
├── mydb/                   # SQL dumps / sample database schema
├── system/                 # CodeIgniter core framework files
├── uploads/                 # User-uploaded files
└── index.php                # Application entry point
```

## Core Modules / Features

- **User & Role Management** — Admin, Teacher, Parent/Student, Accountant, Librarian roles with separate dashboards
- **Academics** — Classes, sections, subjects, syllabus, timetable, online classes, homework/assignments
- **Examinations** — Exams, exam schedules, grading, marks, result generation
- **Attendance** — Student and staff (teacher) attendance tracking
- **Fee Management** — Fee types/groups/discounts, fee vouchers, student fee payments, balance sheet
- **Accounting** — Income, expenses, transactions, staff salary payments, financial reports
- **Library** — Books, book issue/return, library members
- **Hostel & Transport** — Hostel/room management, vehicle & route management
- **Communication** — Notifications, email/SMS configuration
- **Multi-language support** — Language and phrase management
- **REST API** — `application/controllers/api/` for mobile app integration (auth, student/teacher/staff/class lookups)

## Requirements

- PHP 7.4
- MySQL/MariaDB
- Apache/Nginx (developed with XAMPP)

## Installation

1. Clone/copy the project into your web server root (e.g. `htdocs/school` for XAMPP).
2. Create a MySQL database and import a schema from `mydb/` (e.g. `pluged5_plugedin.sql` or `tecnogat_smart_school_management.sql`).
3. Configure the database connection in `application/config/database.php`:
   ```php
   'hostname' => 'localhost',
   'database' => 'school',
   ```
4. Set the base URL in `application/config/config.php`:
   ```php
   $config['base_url'] = 'http://localhost/school/';
   ```
5. Visit `http://localhost/school/` in your browser.

## Notes

- `upload_guide.txt` documents the deployment process for multiple client sites/databases — not relevant for local development.
- The `apis/` directory at the project root contains standalone legacy PHP scripts separate from the CodeIgniter `application/controllers/api/` REST controllers.
