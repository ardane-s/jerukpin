# JerukPin Database Setup Instructions

## Step 1: Configure .env File

Update your `.env` file with the following settings:

```env
APP_NAME=JerukPin
APP_ENV=local
APP_TIMEZONE="Asia/Jakarta"
APP_URL=http://jerukpin.test

APP_LOCALE=id
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=id_ID

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jerukpin
DB_USERNAME=root
DB_PASSWORD=
```

## Step 2: Create Database

Run this SQL command in your MySQL client or phpMyAdmin:

```sql
CREATE DATABASE jerukpin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## Step 3: Run Migrations

```bash
php artisan migrate
```

## Step 4: Seed Database (after creating seeders)

```bash
php artisan db:seed
```
