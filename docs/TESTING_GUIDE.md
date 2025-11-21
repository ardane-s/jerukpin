# 🧪 JerukPin - Complete Testing Guide

## Prerequisites

1. **Start the server:**
```bash
php artisan serve
```

2. **Verify database is seeded:**
- 1 super admin
- 3 categories
- 5 products with 13 variants

---

## ✅ Test Checklist

### 1. Customer - Product Browsing

**Homepage (http://localhost:8000)**
- [ ✅ ] Hero section displays
- [ ✅ ] Flash sales section (if any active)
- [ ✅ ] Best sellers section (Jeruk Madu Premium should have ⭐)
- [ ✅ ] New arrivals section
- [ ✅ ] Category cards (3 categories)

**Product Listing (/products)**
- [ ✅ ] All products display
- [ ✅ ] Filter by category works
- [ error ] Sort by latest/popular/price works
- [ ✅ ] Product cards show images
- [ ✅ ] Best seller badge appears

**Product Detail (click any product)**
- [ ✅ ] Image gallery displays
- [ ✅ ] Click thumbnails changes main image
- [ ✅ ] Variants listed with prices
- [ ✅ ] Stock displayed
- [ ✅ ] Related products shown
- [ not yet ] Reviews section (if any)

---

### 2. Customer - Shopping Cart

**Add to Cart**
- [ ✅ - but no notification if the product is added to the cart ] Click product → Select variant → "Add to Cart"
- [ i dont think so ] Success message appears
- [ i dont think so ] Cart icon updates (if implemented)

**Cart Page (/cart)**
- [ ✅ ] All items display with images
- [ ✅ ] Quantities can be updated
- [ ✅ ] Items can be removed
- [ ✅ ] Subtotal calculates correctly
- [ ✅ ] "Clear Cart" works
- [ ✅ ] "Continue Shopping" link works

---

### 3. Customer - Checkout (Guest)

**Checkout Flow**
- [ ✅ ] Click "Checkout" from cart
- [ ✅ ] Guest form displays (name, email, phone, address)
- [ ✅ - customer setting the cost? i should be the admin ] Shipping cost field (default 10000)
- [ ✅ ] Total updates when shipping changes
- [ ✅ ] Order items summary shows
- [ error ] Submit creates order

**Order Confirmation**
- [ nothing ] Redirects to order detail
- [ nothing ] Order number displays
- [ nothing ] Payment instructions show (BCA bank details)
- [ nothing ] "Upload Payment Proof" button visible

---

### 4. Customer - Payment Upload

**Upload Proof**
- [ nothing ] Click "Upload Payment Proof"
- [ nothing ] Form displays (image, date, amount, bank, account name)
- [ nothing ] Image upload works (max 5MB)
- [ nothing ] Submit uploads successfully
- [ nothing ] Status changes to "Payment Uploaded"

---

### 5. Customer - Order Tracking (Guest)

**Track Order (/orders/track)**
- [ nothing ] Enter order number
- [ nothing ] Enter email (guest email used at checkout)
- [ nothing ] Submit shows order detail
- [ nothing ] Wrong email shows error

---

### 6. Member - Registration & Login

**Register**
- [ nothing ] Click "Register" (if using Breeze default)
- [ nothing ] Create account
- [ nothing ] Login successful

**Member Features**
- [ nothing ] Cart persists in database
- [ nothing ] "My Orders" link appears in nav
- [ nothing ] Can view order history (/my-orders)
- [ nothing ] Can use saved addresses (if any)

---

### 7. Admin - Login

**Admin Login (/login)**
- [ ✅ ] Email: admin@jerukpin.com
- [ ✅ ] Password: password
- [ ✅ ] Redirects to admin panel
- [ ✅ ] Navigation shows: Categories, Products, Flash Sales, Orders

---

### 8. Admin - Category Management

**Categories (/admin/categories)**
- [ ✅ ] View 3 seeded categories
- [ ✅ ] Product count displays
- [ ✅ ] Status badges show

**Create Category**
- [ ✅ ] Click "Add Category"
- [ ✅ ] Enter name (auto-slug generates)
- [ ✅ ] Enter description
- [ ✅ ] Set active status
- [ ✅ ] Submit creates category

**Edit Category**
- [ ✅ ] Click "Edit"
- [ ✅ ] Modify name/description
- [ ✅ ] Toggle active status
- [ ✅ ] Submit updates

**Delete Category**
- [ ✅ ] Try deleting category with products (should fail)
- [ ✅ ] Delete empty category (should succeed)

---

### 9. Admin - Product Management

**Products (/admin/products)**
- [ ✅ ] View 5 seeded products
- [ ✅ ] Images display
- [ ✅ ] Best seller badge on Jeruk Madu Premium
- [ ✅ ] Variant count shows
- [ ✅ ] Sold count displays

**Create Product**
- [ ✅ ] Click "Add Product"
- [ ✅ ] Select category
- [ ✅ ] Enter name (auto-slug)
- [ ✅ ] Enter description
- [ ✅ ] Add first variant (name, SKU, price, stock)
- [ ✅ ] Set active status
- [ ✅ ] Submit creates product
- [ ✅ ] Redirects to edit page for image upload

**Edit Product**
- [ ✅ ] Click "Edit" on product
- [ ✅ ] Update product info works
- [ ✅ ] Upload images (max 5)
- [ ✅ ] Set primary image
- [ ✅ ] Delete image
- [ ✅ ] Add new variant
- [ ✅ ] Delete variant (minimum 1 enforced)
- [ ✅ ] Update variant stock/price

---

### 10. Admin - Flash Sale Management

**Flash Sales (/admin/flash-sales)**
- [ ✅ ] View flash sales (if any)
- [ ✅ ] Status indicators (active/upcoming/ended)
- [ ✅ ] Discount percentage displays

**Create Flash Sale**
- [ ✅ ] Click "Create Flash Sale"
- [ ✅ ] Select variant (only variants without active sales)
- [ ✅ ] Enter flash price (must be < original price)
- [ ✅ ] Enter flash stock (must be ≤ variant stock)
- [ ✅ ] Set start time (must be future)
- [ ✅ ] Set end time (must be after start)
- [ ✅ ] Submit creates flash sale

**Edit Flash Sale**
- [ ✅ ] Modify price/stock/times
- [ ✅ ] Toggle active status
- [ ✅ ] Deactivate active sale

---

### 11. Admin - Order Management

**Orders (/admin/orders)**
- [ nothing ] View all orders
- [ nothing ] Filter by status works
- [ nothing ] Payment indicator shows (📎 if proof uploaded)
- [ nothing ] Guest vs Member indicator

**Order Detail**
- [ nothing ] Click order to view detail
- [ nothing ] Order items display
- [ nothing ] Customer info shows
- [ nothing ] Flash sale badge on items (if applicable)

**Payment Verification**
- [ nothing ] Order with uploaded proof shows image
- [ nothing ] Payment details display (date, amount, bank, account)
- [ nothing ] "Verify Payment" button visible
- [ nothing ] Click verify:
  - [ nothing ] Status changes to "Processing"
  - [ nothing ] Sold counts update (check product detail)
  - [ nothing ] Success message shows

**Payment Rejection**
- [ nothing ] Click "Reject Payment"
- [ nothing ] Enter rejection reason
- [ nothing ] Submit rejects payment
- [ nothing ] Status returns to "Pending Payment"

**Status Update**
- [ nothing ] Change status dropdown
- [ nothing ] Update to "Shipped"
- [ nothing ] Update to "Delivered"

---

## 🐛 Common Issues & Fixes

### Images Not Displaying
```bash
php artisan storage:link
```

### Cart Not Working
- Check session configuration
- Clear browser cookies
- Check database connection

### Payment Upload Fails
- Check storage permissions
- Verify max upload size in php.ini

### Sold Count Not Updating
- Verify payment is verified (not just uploaded)
- Check ProductVariant model has incrementSoldCount method

---

## 📊 Expected Results

After testing, you should have:
- ✅ Multiple orders in different statuses
- ✅ Updated sold counts on products
- ✅ Payment proofs uploaded and verified
- ✅ Cart working for both guests and members
- ✅ All CRUD operations functional

---

## 🎯 Next Steps After Testing

1. **If bugs found:** Document and fix
2. **If all working:** Consider Sprint 4 (Reviews) or deploy
3. **Production prep:** Environment config, security, optimization

---

**Start testing now!** 🚀

Open http://localhost:8000 and go through each checklist item.
