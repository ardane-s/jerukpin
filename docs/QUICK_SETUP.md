# JerukPin - Quick Setup Guide

## 🚀 Complete These Steps Now

### Step 1: Database Configuration (1 minute)

Your `.env` file should have these settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jerukpin
DB_USERNAME=root
DB_PASSWORD=
```

### Step 2: Create Database (30 seconds)

**Option A - Using phpMyAdmin:**
1. Open http://localhost/phpmyadmin
2. Click "New" in the left sidebar
3. Database name: `jerukpin`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

**Option B - Using MySQL Command:**
```sql
CREATE DATABASE jerukpin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 3: Run Migrations (1 minute)

```bash
cd c:\laragon\www\jerukpin_gag_ver
php artisan migrate
```

**Expected output:** 16 migrations should run successfully.

### Step 4: Seed Super Admin (10 seconds)

```bash
php artisan db:seed --class=SuperAdminSeeder
```

**Expected output:**
```
Super Admin created successfully!
Email: admin@jerukpin.com
Password: password
```

### Step 5: Build Frontend Assets (1 minute)

```bash
npm run build
```

If you get PowerShell execution policy error, run this first:
```bash
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
```

### Step 6: Start Development Server

```bash
php artisan serve
```

Visit: http://localhost:8000

---

## ✅ Verification Checklist

After completing the steps above, verify:

- [ ] Database `jerukpin` exists with 16 tables
- [ ] Super admin account exists (check `users` table)
- [ ] Can access http://localhost:8000
- [ ] Can login with admin@jerukpin.com / password
- [ ] Tailwind CSS is working (orange/green colors visible)

---

## 🎯 What's Next?

Once setup is verified, we'll start **Sprint 2: Core Store**:

1. **Admin Product Management**
   - Create categories
   - Add products with variants
   - Upload product images
   - Manage flash sales

2. **Customer Product Browsing**
   - Homepage with featured products
   - Category pages
   - Product detail pages
   - Search functionality

3. **Shopping Cart**
   - Add to cart
   - Update quantities
   - Cart persistence

---

## 🐛 Troubleshooting

**Migration Error:**
```bash
php artisan migrate:fresh
php artisan db:seed --class=SuperAdminSeeder
```

**NPM Error:**
```bash
npm cache clean --force
npm install
npm run build
```

**Port 8000 in use:**
```bash
php artisan serve --port=8001
```

---

Ready to continue? Let me know when setup is complete! 🚀
