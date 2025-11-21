# 🍊 JerukPin - Premium Orange E-commerce Platform

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**JerukPin** is a modern, full-featured e-commerce platform specialized in orange products and citrus-based goods. Built with Laravel 11, it offers a seamless shopping experience for both customers and administrators.

---

## ✨ Features

### 🛒 Customer Features
- **Product Browsing** - Browse 135+ products across 8 categories with beautiful UI
- **Flash Sales** - Time-limited deals with live countdown and stock tracking
- **Smart Cart** - Real-time cart management with coupon support
- **Wishlist** - Save favorite products for later
- **Guest & Member Checkout** - Flexible checkout for all users
- **Order Tracking** - Track orders with unique order numbers
- **Payment Upload** - Upload proof of payment with image preview
- **Printable Invoices** - Professional invoice generation for completed orders
- **Product Reviews** - Rate and review purchased products
- **Multiple Payment Methods** - Bank Transfer, E-Wallet, Cash on Delivery

### 👨‍💼 Admin Features
- **Dashboard** - Comprehensive overview of sales, orders, and products
- **Product Management** - Full CRUD with variants, images, and stock control
- **Category Management** - Organize products into categories
- **Flash Sale Management** - Create and manage time-limited promotions
- **Order Management** - Process orders, verify payments, update status
- **Review Moderation** - Monitor and manage customer reviews

### 🎨 Design Highlights
- **Modern Gradient UI** - Eye-catching orange-themed design
- **Responsive Layout** - Perfect on desktop, tablet, and mobile
- **Smooth Animations** - Micro-interactions for enhanced UX
- **Orange Placeholders** - Branded 🍊 emoji placeholders for missing images
- **Animated Notifications** - Pulsing promo indicator in navbar
- **Custom Modals** - Beautiful confirmation dialogs

---

## 🗂️ Product Categories

1. **🍊 Jeruk Segar** - Fresh oranges (weight-based variants: 500g, 1kg, 2kg, 5kg)
2. **🧃 Jus & Minuman** - Juices & drinks (volume-based: 250ml, 500ml, 1L, 2L)
3. **🍯 Selai & Olahan** - Jams & processed (jar-based: 200g, 500g, multi-packs)
4. **🎁 Paket Hadiah** - Gift packages (set-based: Small, Medium, Large, Premium)
5. **🌱 Produk Organik** - Organic products (premium weight-based)
6. **🍪 Snack Jeruk** - Orange snacks (pack-based: 1, 3, 5, 10 packs)
7. **💄 Perawatan Kulit** - Skincare (volume-based: 30ml, 50ml, 100ml)
8. **🕯️ Aromaterapi** - Aromatherapy (volume-based: 10ml, 30ml, 50ml)

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL 8.0+
- Laragon (recommended) or XAMPP

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/ardane-s/JerukPin.git
cd JerukPin
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database** (edit `.env`)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jerukpin
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seed data**
```bash
php artisan migrate:fresh --seed --seeder=FreshIndonesianDataSeeder
```

6. **Build assets**
```bash
npm run build
```

7. **Start development server**
```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

---

## 👤 Default Credentials

### Admin Account
- **Email:** admin@jerukpin.com
- **Password:** admin123

### Member Accounts
12 pre-seeded member accounts available:
- **Email:** budi.santoso@gmail.com (and 11 others)
- **Password:** password123

---

## 📊 Database Schema

### Key Tables
- `users` - User accounts (admin, members)
- `categories` - Product categories
- `products` - Product information
- `product_variants` - Product variants (size, weight, volume)
- `product_images` - Product images
- `flash_sales` - Flash sale promotions
- `carts` & `cart_items` - Shopping cart
- `orders` & `order_items` - Order management
- `payments` & `payment_proofs` - Payment tracking
- `reviews` - Product reviews
- `wishlists` - User wishlists
- `addresses` - Saved shipping addresses

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** MySQL 8.0
- **Authentication:** Laravel Breeze

### Frontend
- **CSS Framework:** Tailwind CSS 3.x
- **JavaScript:** Vanilla JS + Alpine.js (via Breeze)
- **Build Tool:** Vite
- **Icons:** Heroicons, Emoji

### Development
- **Server:** Laragon / XAMPP
- **Version Control:** Git
- **Package Manager:** Composer, NPM

---

## 📁 Project Structure

```
jerukpin/
├── app/
│   ├── Http/Controllers/      # Application controllers
│   ├── Models/                # Eloquent models
│   └── View/Composers/        # View composers
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   ├── views/
│   │   ├── admin/            # Admin panel views
│   │   ├── customer/         # Customer-facing views
│   │   ├── auth/             # Authentication views
│   │   └── layouts/          # Layout templates
│   └── css/                  # Stylesheets
├── routes/
│   └── web.php               # Web routes
├── public/                   # Public assets
└── docs/                     # Documentation
```

---

## 🎯 Key Features Breakdown

### Flash Sale System
- Time-based promotions with countdown
- Limited stock tracking
- Automatic price calculation
- Live status indicators
- Multiple concurrent sessions

### Order Management
- Guest and member orders
- Multiple payment methods
- Payment proof upload
- Order status tracking
- Printable invoices
- Order cancellation (for pending/uploaded payments)

### Product Variants
- Category-appropriate variants
- Dynamic pricing
- Stock management per variant
- SKU generation
- 540 pre-seeded variants

### Shopping Experience
- Real-time cart updates
- Coupon system
- Wishlist functionality
- Product reviews & ratings
- Guest checkout support

---

## 📝 Seeded Data

The `FreshIndonesianDataSeeder` provides:
- **8 categories** with descriptions
- **135 products** across all categories
- **540 product variants** (4 per product)
- **37 flash sales** (3 active sessions)
- **71 orders** with realistic data
- **35 product reviews**
- **12 member accounts**
- **1 admin account**

---

## 🔐 Security Features

- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection prevention (Eloquent ORM)
- XSS protection
- Authentication middleware
- Role-based access control (Admin/Member)
- Secure file uploads

---

## 🎨 UI/UX Highlights

- **Orange Brand Theme** - Consistent orange gradient throughout
- **Smooth Animations** - Hover effects, transitions, micro-interactions
- **Responsive Design** - Mobile-first approach
- **Custom Components** - Product cards, modals, dropdowns
- **Loading States** - Skeleton screens and spinners
- **Error Handling** - User-friendly error messages
- **Success Feedback** - Toast notifications and confirmations

---

## 📖 Documentation

Detailed documentation available in the `docs/` folder:
- Sprint progress reports
- Feature implementation guides
- Testing guides
- Database setup instructions
- UI enhancement documentation

---

## 🤝 Contributing

This is a personal project, but suggestions and feedback are welcome!

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Developer

**Komang Aris**
- GitHub: [@ardane-s](https://github.com/ardane-s)
- Email: komangaris2910@gmail.com

---

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Heroicons
- Indonesian Orange Farmers 🍊

---

**Built with ❤️ and 🍊 in Indonesia**
