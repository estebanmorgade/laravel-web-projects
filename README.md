# Laravel Web Project 🧱

This is a Laravel-based portfolio manager built as part of a full-stack developer training.
It allows me to create and manage projects for showcasing purposes.

## 🔧 Technologies

- Laravel 10
- PHP 8.1
- PostgreSQL
- Bootstrap 5.2

## 🧰 Features

- Public portfolio listing (`Index`, `Show`)
- Admin features:
  - Create, edit, and soft-delete projects
- Superadmin features:
  - View soft-deleted projects
  - Restore or permanently delete them

## 📸 Screenshots

![Project list](./screenshots/index.png)

## ⚙️ Local running

```bash
git clone https://github.com/tu-usuario/laravel-course-project.git
cd laravel-course-project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve

---

🧑‍💻 Developed by Esteban Morgade  
📬 [LinkedIn](www.linkedin.com/in/esteban-morgade-8a7634176) 