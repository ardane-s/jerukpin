<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\FlashSale;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ComprehensiveDataSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear ALL existing data
        Review::truncate();
        OrderItem::truncate();
        Order::truncate();
        FlashSale::truncate();
        ProductImage::truncate();
        ProductVariant::truncate();
        Product::truncate();
        Category::truncate();
        User::whereNotIn('email', ['admin@jerukpin.com'])->delete();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Super Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@jerukpin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'phone' => '081234567890'
            ]
        );

        // Create Members
        $members = [];
        $memberNames = ['Budi Santoso', 'Siti Aminah', 'Ahmad Rizki', 'Dewi Lestari', 'Eko Prasetyo', 'Rina Wijaya', 'Agus Setiawan', 'Maya Putri', 'Doni Prakoso', 'Linda Sari', 'Hendra Gunawan', 'Fitri Handayani'];
        foreach ($memberNames as $name) {
            $members[] = User::create([
                'name' => $name,
                'email' => Str::slug($name) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone' => '0812' . rand(10000000, 99999999)
            ]);
        }

        // Create Realistic Indonesian Categories
        $categories = [
            ['name' => 'Jeruk Segar', 'description' => 'Aneka jeruk segar pilihan dari berbagai daerah'],
            ['name' => 'Jus & Minuman', 'description' => 'Jus jeruk segar dan minuman olahan jeruk'],
            ['name' => 'Selai & Olahan', 'description' => 'Selai jeruk, marmalade, dan produk olahan lainnya'],
            ['name' => 'Paket Hadiah', 'description' => 'Paket hampers dan hadiah jeruk premium'],
            ['name' => 'Produk Organik', 'description' => 'Jeruk dan produk organik bersertifikat'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'is_active' => true
            ]);
        }

        // Create 75 Realistic Indonesian Citrus Products
        $products = [
            // Jeruk Segar (25 products)
            ['Jeruk Pontianak Super', 0, 'Jeruk manis khas Pontianak, tanpa biji', 35000],
            ['Jeruk Medan Premium', 0, 'Jeruk manis khas Medan, sangat segar', 42000],
            ['Jeruk Bali Merah', 0, 'Jeruk bali merah segar kaya antioksidan', 48000],
            ['Jeruk Santang Madu', 0, 'Jeruk santang manis seperti madu', 38000],
            ['Jeruk Keprok Batu 55', 0, 'Jeruk keprok batu 55 manis dan segar', 36000],
            ['Jeruk Siam Pontianak', 0, 'Jeruk siam tanpa biji khas Pontianak', 40000],
            ['Jeruk Kintamani Bali', 0, 'Jeruk khas Bali dengan rasa unik', 45000],
            ['Jeruk Nipis Segar', 0, 'Jeruk nipis segar untuk masakan', 25000],
            ['Jeruk Purut Segar', 0, 'Jeruk purut untuk bumbu masakan', 28000],
            ['Jeruk Lemon Import', 0, 'Lemon import berkualitas premium', 55000],
            ['Jeruk Mandarin Premium', 0, 'Jeruk mandarin manis dan mudah dikupas', 50000],
            ['Jeruk Baby Mandarin', 0, 'Jeruk mandarin mini manis', 48000],
            ['Jeruk Garut Asli', 0, 'Jeruk garut asli Jawa Barat', 37000],
            ['Jeruk Manis Lokal', 0, 'Jeruk manis lokal berkualitas', 33000],
            ['Jeruk Sunkist California', 0, 'Jeruk sunkist import California', 60000],
            ['Jeruk Limau Segar', 0, 'Jeruk limau untuk minuman segar', 30000],
            ['Jeruk Dekopon Jepang', 0, 'Jeruk dekopon import Jepang', 85000],
            ['Jeruk Valencia', 0, 'Jeruk valencia untuk jus', 38000],
            ['Jeruk Navel Australia', 0, 'Jeruk navel import Australia', 65000],
            ['Jeruk Keprok Garut', 0, 'Jeruk keprok khas Garut', 34000],
            ['Jeruk Siam Madu', 0, 'Jeruk siam manis seperti madu', 41000],
            ['Jeruk Medan Asli', 0, 'Jeruk medan asli Sumatera', 39000],
            ['Jeruk Bali Asli', 0, 'Jeruk bali asli Indonesia', 44000],
            ['Jeruk Santang Garut', 0, 'Jeruk santang khas Garut', 36000],
            ['Jeruk Manis Medan', 0, 'Jeruk manis khas Medan', 40000],
            
            // Jus & Minuman (18 products)
            ['Jus Jeruk Segar 500ml', 1, 'Jus jeruk segar tanpa pengawet', 20000],
            ['Jus Jeruk Segar 1L', 1, 'Jus jeruk segar kemasan 1 liter', 35000],
            ['Jus Jeruk Nipis', 1, 'Jus jeruk nipis segar', 18000],
            ['Jus Lemon Segar', 1, 'Jus lemon segar untuk detox', 22000],
            ['Jus Jeruk Bali', 1, 'Jus jeruk bali merah segar', 25000],
            ['Sirup Jeruk Homemade', 1, 'Sirup jeruk buatan rumah', 30000],
            ['Sirup Lemon Homemade', 1, 'Sirup lemon buatan rumah', 32000],
            ['Konsentrat Jus Jeruk', 1, 'Konsentrat jus jeruk 500ml', 40000],
            ['Es Jeruk Peras Kemasan', 1, 'Es jeruk peras siap minum', 15000],
            ['Minuman Jeruk Nipis Madu', 1, 'Jeruk nipis dengan madu asli', 25000],
            ['Infused Water Jeruk', 1, 'Air infus jeruk segar', 18000],
            ['Jus Jeruk Campur', 1, 'Jus campuran berbagai jeruk', 28000],
            ['Lemonade Segar', 1, 'Lemonade segar buatan sendiri', 20000],
            ['Jus Jeruk Organik', 1, 'Jus jeruk organik tanpa gula', 35000],
            ['Minuman Jeruk Hangat', 1, 'Minuman jeruk hangat dengan jahe', 22000],
            ['Jus Jeruk Vitamin C', 1, 'Jus jeruk tinggi vitamin C', 30000],
            ['Smoothie Jeruk', 1, 'Smoothie jeruk dengan yogurt', 35000],
            ['Teh Jeruk Segar', 1, 'Teh dengan perasan jeruk segar', 18000],
            
            // Selai & Olahan (15 products)
            ['Selai Jeruk Homemade', 2, 'Selai jeruk buatan rumah', 35000],
            ['Marmalade Jeruk', 2, 'Marmalade jeruk dengan kulit', 38000],
            ['Selai Lemon', 2, 'Selai lemon segar', 36000],
            ['Manisan Jeruk', 2, 'Manisan jeruk kering', 30000],
            ['Kulit Jeruk Manisan', 2, 'Kulit jeruk manisan manis', 32000],
            ['Dodol Jeruk', 2, 'Dodol dengan rasa jeruk', 28000],
            ['Keripik Kulit Jeruk', 2, 'Keripik kulit jeruk renyah', 25000],
            ['Acar Jeruk Nipis', 2, 'Acar jeruk nipis pedas', 30000],
            ['Saus Jeruk', 2, 'Saus jeruk untuk masakan', 35000],
            ['Madu Jeruk', 2, 'Madu dengan ekstrak jeruk', 45000],
            ['Sirup Kulit Jeruk', 2, 'Sirup dari kulit jeruk', 33000],
            ['Permen Jeruk', 2, 'Permen rasa jeruk alami', 20000],
            ['Coklat Jeruk', 2, 'Coklat dengan filling jeruk', 40000],
            ['Kue Kering Jeruk', 2, 'Kue kering rasa jeruk', 35000],
            ['Nastar Selai Jeruk', 2, 'Nastar dengan selai jeruk', 45000],
            
            // Paket Hadiah (10 products)
            ['Paket Hampers Premium', 3, 'Hampers jeruk premium lengkap', 200000],
            ['Paket Gift Box Jeruk', 3, 'Gift box jeruk segar eksklusif', 150000],
            ['Paket Keluarga 5kg', 3, 'Paket hemat jeruk 5kg', 120000],
            ['Paket Lebaran Spesial', 3, 'Paket hampers lebaran', 250000],
            ['Paket Corporate Gift', 3, 'Paket hadiah untuk perusahaan', 300000],
            ['Paket Parcel Jeruk', 3, 'Parcel jeruk dan olahan', 180000],
            ['Paket Gift Organik', 3, 'Paket hadiah jeruk organik', 220000],
            ['Paket Hampers Deluxe', 3, 'Hampers deluxe dengan produk premium', 280000],
            ['Paket Souvenir Pernikahan', 3, 'Paket souvenir jeruk untuk nikahan', 160000],
            ['Paket Ulang Tahun', 3, 'Paket hadiah ulang tahun', 175000],
            
            // Produk Organik (7 products)
            ['Jeruk Organik Pontianak', 4, 'Jeruk organik bersertifikat Pontianak', 55000],
            ['Jeruk Organik Medan', 4, 'Jeruk organik bersertifikat Medan', 58000],
            ['Jus Jeruk Organik', 4, 'Jus jeruk organik tanpa gula', 38000],
            ['Selai Jeruk Organik', 4, 'Selai jeruk organik homemade', 45000],
            ['Jeruk Nipis Organik', 4, 'Jeruk nipis organik segar', 35000],
            ['Lemon Organik', 4, 'Lemon organik import', 60000],
            ['Paket Organik Mix', 4, 'Paket campuran produk organik', 150000],
        ];

        $productModels = [];
        foreach ($products as $index => $prod) {
            // Make first 15 products "new" (created today)
            $createdAt = $index < 15 ? now() : now()->subDays(rand(2, 45));
            
            $product = Product::create([
                'category_id' => $categoryModels[$prod[1]]->id,
                'name' => $prod[0],
                'slug' => Str::slug($prod[0]) . '-' . ($index + 1),
                'description' => $prod[2],
                'total_sold_count' => rand(10, 300),
                'is_active' => true,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Create 3 variants per product
            $variants = [
                ['name' => '250gr', 'price' => $prod[3] * 0.5, 'stock' => rand(80, 250)],
                ['name' => '500gr', 'price' => $prod[3], 'stock' => rand(50, 200)],
                ['name' => '1kg', 'price' => $prod[3] * 1.8, 'stock' => rand(30, 150)],
            ];

            foreach ($variants as $var) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_name' => $var['name'],
                    'sku' => 'JRK-' . strtoupper(Str::random(6)),
                    'price' => round($var['price']),
                    'stock' => $var['stock'],
                    'sold_count' => rand(5, 100)
                ]);
            }

            // Create placeholder image
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/placeholder-orange.jpg',
                'is_primary' => true,
                'sort_order' => 1
            ]);

            $productModels[] = $product;
        }

        // Create 12 Flash Sales
        $flashProducts = collect($productModels)->random(12);
        foreach ($flashProducts as $product) {
            $variant = $product->variants->random();
            FlashSale::create([
                'product_variant_id' => $variant->id,
                'flash_price' => round($variant->price * rand(60, 75) / 100),
                'original_price' => $variant->price,
                'flash_stock' => rand(25, 100),
                'flash_sold' => rand(5, 30),
                'start_time' => now(),
                'end_time' => now()->addDays(rand(2, 7)),
                'is_active' => true
            ]);
        }

        // Create Orders and Reviews
        foreach ($members as $member) {
            for ($i = 0; $i < rand(3, 6); $i++) {
                $order = Order::create([
                    'user_id' => $member->id,
                    'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                    'status' => collect(['delivered', 'shipped', 'processing', 'delivered', 'delivered'])->random(),
                    'subtotal' => 0,
                    'shipping_cost' => 10000,
                    'total' => 0,
                    'guest_name' => $member->name,
                    'guest_email' => $member->email,
                    'guest_phone' => $member->phone,
                    'guest_address' => 'Jl. ' . collect(['Merdeka', 'Sudirman', 'Thamrin', 'Gatot Subroto', 'Ahmad Yani'])->random() . ' No. ' . rand(1, 200) . ', Jakarta ' . collect(['Pusat', 'Selatan', 'Utara', 'Barat', 'Timur'])->random() . ' 12' . rand(100, 999),
                ]);

                $subtotal = 0;
                $orderProducts = collect($productModels)->random(rand(2, 5));
                
                foreach ($orderProducts as $product) {
                    $variant = $product->variants->random();
                    $quantity = rand(1, 4);
                    $price = $variant->price;
                    
                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
                        'product_name' => $product->name,
                        'variant_name' => $variant->variant_name,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $subtotal += $price * $quantity;

                    // Create reviews (85% chance for delivered orders)
                    if ($order->status === 'delivered' && rand(1, 100) <= 85) {
                        Review::create([
                            'order_item_id' => $orderItem->id,
                            'user_id' => $member->id,
                            'product_id' => $product->id,
                            'rating' => rand(4, 5),
                            'comment' => $this->getRandomReview(),
                        ]);
                    }
                }

                $order->update([
                    'subtotal' => $subtotal,
                    'total' => $subtotal + 10000
                ]);
            }
        }

        $this->command->info('✅ Data Indonesia lengkap berhasil dibuat!');
        $this->command->info('📊 Dibuat:');
        $this->command->info('   - ' . count($categoryModels) . ' kategori');
        $this->command->info('   - ' . count($productModels) . ' produk');
        $this->command->info('   - ' . ProductVariant::count() . ' varian');
        $this->command->info('   - ' . FlashSale::count() . ' flash sale');
        $this->command->info('   - ' . Order::count() . ' pesanan');
        $this->command->info('   - ' . Review::count() . ' review');
        $this->command->info('   - ' . count($members) . ' member');
    }

    private function getRandomReview(): string
    {
        $reviews = [
            'Jeruknya segar banget! Pasti order lagi.',
            'Kualitas premium, harga terjangkau. Recommended!',
            'Pengiriman cepat, packing rapi. Jeruknya manis.',
            'Sangat puas dengan kualitasnya. Terima kasih!',
            'Jeruk terbaik yang pernah saya beli online.',
            'Fresh dan manis, anak-anak suka banget.',
            'Packaging bagus, jeruk sampai dalam kondisi sempurna.',
            'Harga sebanding dengan kualitas. Worth it!',
            'Sudah langganan, selalu puas.',
            'Jeruknya besar-besar dan segar. Mantap!',
            'Manis dan juicy, recommended!',
            'Pelayanan ramah, produk berkualitas.',
            'Selai jeruknya enak, homemade banget rasanya.',
            'Jus jeruknya segar, tanpa pengawet.',
            'Paket hadiahnya bagus, cocok untuk kado.',
            'Produk organiknya benar-benar alami.',
            'Jeruk Pontianak memang juara!',
            'Jeruk Medan nya manis banget.',
            'Cocok untuk oleh-oleh.',
            'Kualitas export, harga lokal!',
        ];

        return $reviews[array_rand($reviews)];
    }
}
