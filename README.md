<div align="center">

# Cinema Booking System

**A modern movie ticket booking system with real-time seat selection, admin panel, and HD posters.**

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![Tailwind](https://img.shields.io/badge/Tailwind-CSS-blue)
![MySQL](https://img.shields.io/badge/MySQL-8-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

</div>

---

## Screenshots

<div align="center">

### Movie List with HD Posters
![Movie List](screenshots/movies.png)

### Real-Time Seat Selection
![Seat Map](screenshots/seat-map.png)

### Admin Dashboard
![Admin Panel](screenshots/admin.png)

</div>

---

## Features

- Movie browsing with **HD posters**
- **Real-time seat map**: Green = Available, Blue = Selected, Red = Booked
- **Dynamic pricing** per screen
- **Admin panel**: View, edit, delete bookings
- **Secure login** (Customer + Admin)
- **Responsive design** (Mobile & Desktop)

---

## Tech Stack

- **Laravel 12** + Eloquent ORM
- **Tailwind CSS** + Vite
- **MySQL**
- **Laravel Breeze** (Auth)

---

## Quick Setup

```bash
git clone https://github.com/SiratNemati/movie-booking-management-system.git
cd movie-booking-management-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
npm install && npm run build
php artisan serve
```
---

## License
MIT License © Sirat Nemati

