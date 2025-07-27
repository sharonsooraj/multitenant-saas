# Multi-Tenant SaaS Application – Laravel 12

This project is a multi-tenant SaaS application built with Laravel 12, supporting multiple companies, separate invoicing, and tenant-based data isolation.

## 🚀 Features

- Laravel 12 with Bootstrap 5 UI
- Company-based multi-tenant
- 

---

## 🔧 Setup Instructions

1. **Clone the repository**
   
   git clone https://github.com/sharonsooraj/multitenant-saas.git
   cd multitenant-saas
Install dependencies


composer install
npm install && npm run dev
Environment setup

cp .env.example .env
php artisan key:generate

DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=your_password
Run migrations:


php artisan migrate


php artisan serve


## 🔌 API Endpoints

### 🔐 Auth

| Method | Endpoint        | Description       |
|--------|-----------------|-------------------|
| POST   | /api/register   | User registration |
| POST   | /api/login      | User login        |
| POST   | /api/logout     | User logout       |

---

### 🏢 Companies

| Method | Endpoint            | Description              |
|--------|---------------------|--------------------------|
| GET    | /api/companies      | List all companies       |
| POST   | /api/companies      | Create a new company     |
| PUT    | /api/companies/{id} | Update a company         |
| DELETE | /api/companies/{id} | Delete a company         |


