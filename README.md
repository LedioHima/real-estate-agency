<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

# 🏡 Real Estate Agency Platform

A **Laravel-based web application** designed to streamline real estate management for **admins**, **agents**, and **guests**.  
This platform enables property listing, user management, and advanced property searching with an intuitive and responsive UI powered by **Bootstrap 5**.

---

## 🚀 Features

### 👑 **Admin**
- Manage agents and guest users.
- View total statistics: **properties**, **agents**, and **users**.
- Global search and filtering for properties.
- Overview dashboard displaying all property listings.

### 🧑‍💼 **Agent**
- Add, edit, and manage personal property listings.
- Dashboard with personal property stats:
  - Total properties listed
  - Average price
  - Latest listing date
- Property search functionality for quick management.

### 👥 **Guests**
- Browse all properties with a **slideshow hero section**.
- Filter properties by **price**, **city**, or **type**.
- View property details in a **modal popup**.
- Favorites system for logged-in users (❤️ **heart icon**).
- Guests can browse properties even without an account.

---

## 🗃️ Admin Seeder

To create a **default admin account** for testing, run:

```bash
php artisan db:seed --class=AdminSeeder

Email: admin@example.com
Password: admin123

🛠️ Tech Stack

Backend: Laravel 11

Frontend: Blade Templates, Bootstrap 5, Bootstrap Icons

Database: MySQL or SQLite

Authentication: Laravel Breeze (or built-in auth)