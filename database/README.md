# Laravel Multi-Tenant SaaS Project

A Laravel 12-based multi-tenant SaaS application with role-based access, tenant data isolation, and company-specific invoicing.

## 🚀 Setup Instructions

1. Clone the repository:
git clone https://github.com/your-username/laravel-multitenant-saas.git

markdown
Copy
Edit
2. Install dependencies:
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate

markdown
Copy
Edit

3. Configure your `.env` file and database.

4. Run migrations and seeders:
php artisan migrate --seed

yaml
Copy
Edit

## 📡 API Endpoints

| Method | Endpoint        | Description         |
|--------|------------------|---------------------|
| GET    | /invoices        | List all invoices   |
| POST   | /invoices        | Create invoice      |
| GET    | /companies       | List companies      |

## 🧠 Multi-Tenant Logic

- Each company (tenant) has its own invoices and clients.
- Data is scoped by `company_id`.
- Admins can manage multiple companies.

---

## 📦 Tech Stack

- Laravel 12
- Bootstrap 5
- MySQL
- SaaS Multi-Tenant Architecture
