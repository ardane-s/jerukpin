# 🚀 JerukPin - Quick Start Guide

## 1. Start the Server

```bash
cd c:\laragon\www\jerukpin_gag_ver
php artisan serve
```

Server will start at: **http://localhost:8000**

---

## 2. Quick Access Links

### Customer Site
- **Homepage:** http://localhost:8000
- **Products:** http://localhost:8000/products
- **Cart:** http://localhost:8000/cart
- **Track Order:** http://localhost:8000/orders/track

### Admin Panel
- **Login:** http://localhost:8000/login
  - Email: `admin@jerukpin.com`
  - Password: `password`
- **Categories:** http://localhost:8000/admin/categories
- **Products:** http://localhost:8000/admin/products
- **Flash Sales:** http://localhost:8000/admin/flash-sales
- **Orders:** http://localhost:8000/admin/orders

---

## 3. Quick Test Flow

### Customer Journey (5 minutes)
1. Visit homepage
2. Click any product
3. Select variant → Add to cart
4. View cart → Checkout
5. Fill guest info → Create order
6. Upload payment proof

### Admin Journey (3 minutes)
1. Login as admin
2. Go to Orders
3. View order with payment proof
4. Verify payment
5. Check product sold count updated

---

## 4. Sample Data

**Categories:** 3
- Jeruk Segar
- Paket Gift Box
- Produk Organik

**Products:** 5
- Jeruk Madu Premium (127 sold - Best Seller ⭐)
- Jeruk Sunkist Impor (45 sold)
- Jeruk Nipis Segar (23 sold)
- Gift Box Premium (12 sold)
- Jeruk Organik (8 sold)

**Total Variants:** 13

---

## 5. Key Features to Try

✅ **Shopping Cart** - Add/update/remove items
✅ **Guest Checkout** - No registration needed
✅ **Payment Upload** - Image proof system
✅ **Order Tracking** - Track by number + email
✅ **Admin Verification** - Verify payments
✅ **Flash Sales** - Time-based discounts
✅ **Multi-images** - Up to 5 per product
✅ **Variants** - Different sizes/types

---

## 6. Troubleshooting

**Images not showing?**
```bash
php artisan storage:link
```

**Database empty?**
```bash
php artisan migrate:fresh --seed
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

**Permission errors?**
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📖 Full Documentation

- `TESTING_GUIDE.md` - Complete testing checklist
- `PROJECT_STATUS.md` - Full project overview
- `SPRINT_3_COMPLETE.md` - Latest features

---

**🎉 Ready to explore JerukPin!**

Start at: http://localhost:8000
