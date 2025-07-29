# Laravel LMS (Learning Management System)

## Overview

This project is a Learning Management System (LMS) built using Laravel and SQLite. It supports two types of users: **Teachers** and **Students**, each with different roles and access permissions.

The application includes:

- Authentication system with role-based access
- Subject and task management for teachers
- Subject enrollment and solution submission for students
- Responsive user interface with Bootstrap or Tailwind CSS

---

## Setup Instructions

Make sure the following tools are installed:

- PHP >= 8.2
- Composer
- Node.js & npm
- SQLite

Then run the following commands in your terminal:

```
composer install
npm install
npm run dev
php artisan migrate:fresh
php artisan db:seed --class=LmsSeeder
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser to access the application.

---

## Predefined Teacher Accounts

The system contains seeded teacher accounts. Use the following credentials to log in as a teacher:

```
Email: teacher1@example.com
Password: password123
```

---

## Features

### Authentication

- Register (students only)
- Login
- Logout
- Role-based menus and redirection

### Teacher Functions

- Create, view, update, delete subjects (soft deletes enabled)
- View list of enrolled students in each subject
- Create, view, update, delete tasks
- View submitted solutions
- Evaluate solutions with validation

### Student Functions

- View and enroll in available subjects
- Leave enrolled subjects
- View subject details and tasks
- Submit solutions for tasks
- See submission status and points

---

## Design

The application uses a clean and responsive UI powered by either:

- Tailwind CSS  
**or**
- Bootstrap

---

## Notes

- All input forms include validation with error messages.
- Soft deletes are used for subjects to avoid permanent removal.
- Tasks can be submitted multiple times by students.
- Teachers and students have different dashboards and menu options.

---

## Important

Before submitting, please delete the following directories:

```
rm -rf vendor/
rm -rf node_modules/
```

Zip the remaining files and submit as required.
