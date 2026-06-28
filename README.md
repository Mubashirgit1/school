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

## Modules

The app is split into role-based portals under `application/controllers/<role>/`, plus a set of shared/root-level controllers under `application/controllers/`. The default route is `site/login`.

### Authentication & Public Pages (root controllers)

| Controller | Purpose |
|---|---|
| `Site` | Login, session/auth verification, installation checks |
| `Home` | Public marketing/landing page |
| `Welcome` | 404 fallback handler |

### Academic Setup (root controllers)

| Controller | Purpose |
|---|---|
| `Classes` | Class groups, class incharges, fee assignment, student transfers |
| `Sections` | Class sections |
| `Sessions` | Academic sessions/years |
| `Category` | Generic category management |

### Student & Family (root controllers)

| Controller | Purpose |
|---|---|
| `Student` | Student enrollment/records, document uploads/downloads |
| `Family` | Family/guardian relationships, children summaries |
| `Student_assessment` | Student assessment records |

### Fee & Finance (root controllers)

| Controller | Purpose |
|---|---|
| `Fee_management` | Fee collection, receipts, admission vouchers, fee waivers, reports |
| `Feetype` | Fee type CRUD |
| `Studentfee` | Per-student fee processing, SMS notifications on payment |
| `Balance_sheet` | Balance sheet reporting |
| `Transactions` | Daily/bank transactions, account & asset/liability tracking |
| `Report` | Financial reporting |

### System Configuration (root controllers)

| Controller | Purpose |
|---|---|
| `Emailconfig` | Email/SMTP configuration |
| `Smsconfig` | SMS provider configuration (Clickatell, Twilio, custom) |
| `Schsettings` | School-wide settings |
| `Options` | System options |
| `Migrate` | Database migration runner |

---

### Admin Portal (`admin/`)

The most complete module, covering the full admin dashboard:

- **User/Staff management:** `Admin`, `Adminuser`, `Users`, `Staff`, `Teacher`, `Librarian`, `Accountant` — accounts, departments, salary, incentives/deductions
- **Academics:** `Classes`, `Sections`, `Subject`, `Grade`, `Timetable`, `Content`, `Assignment`, `Homework`, `Onlineclass`, `Youtube`, `Vocations`, `Language`
- **Examinations:** `Exam`, `Examschedule`, `Mark`
- **Attendance:** `Stuattendence` (individual/bulk marking, leave requests)
- **Student lifecycle:** `Student`, `Student_assessment`, `Stdtransfer` (promotion/transfer between classes)
- **Fees & accounting:** `Feemaster`, `Feegroup`, `Feetype`, `Feediscount`, `Transaction(s)`, `Paymentsettings`, `Expense`, `Expensehead`, `income`, `incomehead`
- **Hostel & transport:** `Hostel`, `Hostelroom`, `Roomtype`, `Vehicle`, `Vehroute`, `Route`
- **Inventory:** `Inventory`, `InventoryItems`, `InventoryItemIssue`
- **Library:** `Book`, `Member`
- **Communication:** `Notification`

### Teacher Portal (`teacher/`)

Read/limited-write access scoped to the teacher's own classes: `Assignment`, `Book`, `Content`, `Homework`, `Onlineclass`, `Syllabus`, `Vocations`, `Youtube`, `Classes`, `Grade`, `Subject`, `Timetable`, `Exam`, `Examschedule`, `Mark`, `Stuattendence`, `Student`, `Stdtransfer`, `Hostel`, `Hostelroom`, `Route`, `Vehicle`, `Vehroute`, `Notification`, `Teacher`.

### Parent/Student Portal (`parent/`)

- `Parents` — account, document downloads, transaction history, exam results
- `Payment` — online fee payment gateway, success/failure handling, invoices
- `Book`, `Subject`, `Route`, `Hostel`, `Hostelroom`, `Notification` — read-only info views

### Accountant Portal (`accountant/`)

Fee and finance focused: `Accountant`, `Expense`, `Expensehead`, `income`, `incomehead`, `Transaction`, `Report`, `Feemaster`, `Feegroup`, `Feetype`, `Feediscount`, `Studentfee`, `Student`, `Sections`.

### Librarian Portal (`librarian/`)

`Librarian`, `Book` (catalog), `Member` (registration + issue/return/surrender tracking), `Sections`, `Student`, `Teacher` (member lookups).

### General User Portal (`user/`)

Generic student/staff self-service view: `User` (profile, documents), `Attendence`, `Book`, `Content`, `Exam`, `Examschedule`, `Hostel`, `Hostelroom`, `Mark`, `Notification`, `Route`, `Studentfee`, `Subject`, `Teacher`, `Timetable`, `Vehroute`.

### REST API (`api/`)

For the companion mobile app:

| Controller | Purpose |
|---|---|
| `Authenticate` | API login/authentication |
| `ClassApi` | Class details and roll numbers |
| `Student` | Student data, fingerprint enrollment, attendance |
| `Teacher` | Teacher data, fingerprint enrollment, attendance |
| `Staff` | Staff data, fingerprint enrollment, attendance |
| `Option` | Config options (e.g. attendance restriction times) |

### Functional Areas Summary

- **Academics** — classes, sections, subjects, grading, timetable, syllabus, online classes, homework/assignments
- **Examinations** — exam creation, scheduling, marks entry, results
- **Attendance** — student and staff attendance, biometric (fingerprint) support via API
- **Fees & Accounting** — fee types/groups/discounts/vouchers, payments, income/expense, transactions, balance sheet
- **Library** — book catalog, member registration, issue/return tracking
- **Hostel & Transport** — hostel/room allocation, vehicles and routes
- **Inventory** — inventory categories, items, and issue tracking
- **Communication** — notifications, email/SMS configuration
- **Multi-language** — language and phrase management
- **REST API** — mobile app integration

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

- The `apis/` directory at the project root contains standalone legacy PHP scripts separate from the CodeIgniter `application/controllers/api/` REST controllers.
