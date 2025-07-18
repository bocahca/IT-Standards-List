# IT Standards Category

A simple **Laravel 12** application for managing IT standards by category and item.  
Includes:

- **Admin panel** (protected by auth) to create/read/update/delete Categories & Items  
- **Guest view** (public) to browse and search Categories & Items  
- Search (case-insensitive), pagination, “view detail” toggles  
- Tailwind CSS theming (Komdigi brand colors)  
- Breeze auth scaffolding  

---

## 🚀 Features

- **Categories**  
  - Name  
  - CRUD (Admin only)  
  - Preview up to 4 Items on index cards, expandable to full list  
- **Items**  
  - Name, Standard (text), Recommendation (text)  
  - Belongs to a Category  
  - CRUD (Admin only)  
- **Guest views**  
  - Browse all categories & their items  
  - Search across category names, item names, standards & recommendations  
- **Auth**  
  - Admin login via Breeze  
  - Redirect authenticated → `/admin/categories` when visiting `/login`  
- **Styling**  
  - Tailwind CSS with brand palette (primary, secondary, accent)  
  - Responsive layouts, accessible HTML  

---

## 🔧 Requirements

- PHP 8.3+  
- Composer  
- Node.js & npm  
- PostgreSQL (or another supported DB)  

---

## 📥 Installation

1. **Clone & install dependencies**  
   ```bash
   git clone https://github.com/your-org/it-standards-category.git
   cd it-standards-category
   composer install
   npm install
   ```

2. **Environment**  
   - Copy `.env.example` → `.env`  
   - Set your database credentials, APP_NAME, ADMIN_EMAIL & ADMIN_PASSWORD  
   ```dotenv
   APP_NAME="IT Standards"
   APP_ENV=local
   APP_URL=http://localhost

   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=it_standards
   DB_USERNAME=postgres
   DB_PASSWORD=secret

   ADMIN_EMAIL=admin@example.com
   ADMIN_PASSWORD=supersecret
   ```

3. **Generate app key**  
   ```bash
   php artisan key:generate
   ```

4. **Migrate & seed**  
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminSeeder
   ```

5. **Build assets**  
   ```bash
   npm run dev      # development
   npm run build    # production
   ```

6. **Serve**  
   ```bash
   php artisan serve
   # Visit http://localhost:8000
   ```

---

## 🛠️ Usage

- **Admin**  
  - Visit `/login`, authenticate with your `ADMIN_EMAIL` & `ADMIN_PASSWORD`  
  - You’ll be redirected to `/admin/categories`  
  - Manage categories & items via the CRUD UI  

- **Guest**  
  - Visit `/` to browse all categories  
  - Click **View Detail** on a card to expand full items list  
  - Use the search bar to filter by keywords  

---

## 🔄 Testing

- **Unit & Feature tests** (Pest / PHPUnit)  
  ```bash
  php artisan test
  ```
- **Browser tests** (optional Dusk)  
  ```bash
  php artisan dusk
  ```

---

## 🎨 Theming

- Brand palette & fonts live in `tailwind.config.js` under `theme.extend.colors` & `fontFamily`  
- To change favicon, drop `favicon.png` into `public/` and update `<link rel="icon">` in `resources/views/layouts/app.blade.php`  
- Logo: place `logo-komdigi.png` in `public/images/` and reference via `asset('images/logo-komdigi.png')`  

---
