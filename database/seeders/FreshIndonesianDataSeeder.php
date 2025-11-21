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
use Carbon\Carbon;

class FreshIndonesianDataSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n🗑️  Membersihkan data lama...\n";
        
        // Delete all data except admin user (in correct order for foreign keys)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Review::truncate();
        OrderItem::truncate();
        Order::truncate();
        FlashSale::truncate();
        ProductImage::truncate();
        ProductVariant::truncate();
        Product::truncate();
        Category::truncate();
        User::where('role', '!=', 'super_admin')->delete();
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        echo "✅ Data lama dibersihkan!\n\n";
        
        // Create admin if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@jerukpin.com'],
            [
                'name' => 'Admin JerukPin',
                'password' => bcrypt('admin123'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );
        
        echo "👤 Admin: {$admin->email}\n\n";
        
        // Create 12 member accounts
        echo "👥 Membuat 12 member...\n";
        $members = [];
        $memberNames = [
            'Budi Santoso', 'Siti Aminah', 'Ahmad Rizki', 'Dewi Lestari',
            'Eko Prasetyo', 'Fitri Handayani', 'Gunawan Wijaya', 'Hana Pertiwi',
            'Indra Kusuma', 'Joko Widodo', 'Kartika Sari', 'Lina Marlina'
        ];
        
        foreach ($memberNames as $index => $name) {
            $members[] = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@gmail.com',
                'password' => bcrypt('password123'),
                'role' => 'member',
                'email_verified_at' => now(),
            ]);
        }
        
        // Create 8 categories
        echo "📁 Membuat 8 kategori...\n";
        $categoryData = [
            ['name' => 'Jeruk Segar', 'desc' => 'Jeruk segar pilihan langsung dari kebun'],
            ['name' => 'Jus & Minuman', 'desc' => 'Minuman segar berbahan dasar jeruk'],
            ['name' => 'Selai & Olahan', 'desc' => 'Produk olahan jeruk berkualitas'],
            ['name' => 'Paket Hadiah', 'desc' => 'Paket jeruk premium untuk hadiah'],
            ['name' => 'Produk Organik', 'desc' => 'Jeruk organik tanpa pestisida'],
            ['name' => 'Snack Jeruk', 'desc' => 'Camilan sehat berbahan jeruk'],
            ['name' => 'Perawatan Kulit', 'desc' => 'Produk kecantikan ekstrak jeruk'],
            ['name' => 'Aromaterapi', 'desc' => 'Essential oil dan aromaterapi jeruk'],
        ];
        
        $categories = [];
        foreach ($categoryData as $cat) {
            $categories[] = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['desc'],
                'is_active' => true,
            ]);
        }
        
        // 135 Indonesian Products
        echo "🍊 Membuat 135 produk Indonesia...\n";
        
        $productsData = [
            // Jeruk Segar (25 products)
            ['cat' => 0, 'name' => 'Jeruk Pontianak Super', 'desc' => 'Jeruk manis khas Pontianak dengan rasa segar'],
            ['cat' => 0, 'name' => 'Jeruk Medan Premium', 'desc' => 'Jeruk besar dan manis dari Medan'],
            ['cat' => 0, 'name' => 'Jeruk Bali Merah', 'desc' => 'Jeruk Bali dengan daging buah merah segar'],
            ['cat' => 0, 'name' => 'Jeruk Siam Pontianak', 'desc' => 'Jeruk siam tanpa biji yang manis'],
            ['cat' => 0, 'name' => 'Jeruk Santang Madu', 'desc' => 'Jeruk kecil manis seperti madu'],
            ['cat' => 0, 'name' => 'Jeruk Keprok Batu 55', 'desc' => 'Jeruk keprok unggulan dari Batu'],
            ['cat' => 0, 'name' => 'Jeruk Mandarin Lokal', 'desc' => 'Jeruk mandarin segar pilihan'],
            ['cat' => 0, 'name' => 'Jeruk Lemon California', 'desc' => 'Lemon import berkualitas tinggi'],
            ['cat' => 0, 'name' => 'Jeruk Nipis Segar', 'desc' => 'Jeruk nipis untuk masakan dan minuman'],
            ['cat' => 0, 'name' => 'Jeruk Purut Organik', 'desc' => 'Jeruk purut untuk bumbu masakan'],
            ['cat' => 0, 'name' => 'Jeruk Kalamansi Premium', 'desc' => 'Jeruk kalamansi segar dan asam'],
            ['cat' => 0, 'name' => 'Jeruk Dekopon Jepang', 'desc' => 'Jeruk premium import dari Jepang'],
            ['cat' => 0, 'name' => 'Jeruk Sunkist Jumbo', 'desc' => 'Jeruk sunkist ukuran besar'],
            ['cat' => 0, 'name' => 'Jeruk Valencia Sweet', 'desc' => 'Jeruk valencia manis untuk jus'],
            ['cat' => 0, 'name' => 'Jeruk Navel Orange', 'desc' => 'Jeruk navel tanpa biji'],
            ['cat' => 0, 'name' => 'Jeruk Garut Manis', 'desc' => 'Jeruk lokal Garut yang manis'],
            ['cat' => 0, 'name' => 'Jeruk Pacitan Segar', 'desc' => 'Jeruk khas Pacitan yang segar'],
            ['cat' => 0, 'name' => 'Jeruk Tawangmangu', 'desc' => 'Jeruk dari dataran tinggi Tawangmangu'],
            ['cat' => 0, 'name' => 'Jeruk Kintamani Bali', 'desc' => 'Jeruk organik dari Kintamani'],
            ['cat' => 0, 'name' => 'Jeruk Berastagi Medan', 'desc' => 'Jeruk segar dari Berastagi'],
            ['cat' => 0, 'name' => 'Jeruk Magetan Premium', 'desc' => 'Jeruk unggulan dari Magetan'],
            ['cat' => 0, 'name' => 'Jeruk Seluma Bengkulu', 'desc' => 'Jeruk khas Bengkulu yang manis'],
            ['cat' => 0, 'name' => 'Jeruk Sambas Kalimantan', 'desc' => 'Jeruk manis dari Sambas'],
            ['cat' => 0, 'name' => 'Jeruk Pamelo Besar', 'desc' => 'Jeruk pamelo ukuran jumbo'],
            ['cat' => 0, 'name' => 'Jeruk Limau Kasturi', 'desc' => 'Jeruk limau harum dan segar'],
            
            // Jus & Minuman (20 products)
            ['cat' => 1, 'name' => 'Jus Jeruk Murni 1L', 'desc' => 'Jus jeruk 100% tanpa gula tambahan'],
            ['cat' => 1, 'name' => 'Jus Jeruk Peras Segar', 'desc' => 'Jus jeruk peras langsung'],
            ['cat' => 1, 'name' => 'Minuman Jeruk Nipis', 'desc' => 'Minuman segar jeruk nipis'],
            ['cat' => 1, 'name' => 'Lemon Tea Original', 'desc' => 'Teh lemon segar dan manis'],
            ['cat' => 1, 'name' => 'Orange Squash Concentrate', 'desc' => 'Sirup jeruk konsentrat'],
            ['cat' => 1, 'name' => 'Jeruk Peras Botol 500ml', 'desc' => 'Jus jeruk dalam kemasan botol'],
            ['cat' => 1, 'name' => 'Lemonade Premium', 'desc' => 'Lemonade segar dengan madu'],
            ['cat' => 1, 'name' => 'Jeruk Nipis Madu', 'desc' => 'Minuman jeruk nipis dengan madu'],
            ['cat' => 1, 'name' => 'Orange Smoothie Mix', 'desc' => 'Campuran smoothie jeruk'],
            ['cat' => 1, 'name' => 'Jus Jeruk Vitamin C', 'desc' => 'Jus jeruk diperkaya vitamin C'],
            ['cat' => 1, 'name' => 'Minuman Jeruk Segar 250ml', 'desc' => 'Minuman jeruk kemasan kecil'],
            ['cat' => 1, 'name' => 'Lemon Ginger Drink', 'desc' => 'Minuman lemon jahe hangat'],
            ['cat' => 1, 'name' => 'Orange Juice Pulpy', 'desc' => 'Jus jeruk dengan serat buah'],
            ['cat' => 1, 'name' => 'Jeruk Peras Dingin', 'desc' => 'Jus jeruk dingin siap minum'],
            ['cat' => 1, 'name' => 'Lemon Mint Refresher', 'desc' => 'Minuman lemon mint menyegarkan'],
            ['cat' => 1, 'name' => 'Orange Blast Energy', 'desc' => 'Minuman jeruk berenergi'],
            ['cat' => 1, 'name' => 'Jeruk Nipis Soda', 'desc' => 'Soda jeruk nipis segar'],
            ['cat' => 1, 'name' => 'Lemon Honey Water', 'desc' => 'Air lemon madu untuk detox'],
            ['cat' => 1, 'name' => 'Orange Mocktail Mix', 'desc' => 'Campuran mocktail jeruk'],
            ['cat' => 1, 'name' => 'Jus Jeruk Organik', 'desc' => 'Jus dari jeruk organik pilihan'],
            
            // Selai & Olahan (15 products)
            ['cat' => 2, 'name' => 'Selai Jeruk Homemade', 'desc' => 'Selai jeruk buatan rumah'],
            ['cat' => 2, 'name' => 'Marmalade Orange', 'desc' => 'Marmalade jeruk premium'],
            ['cat' => 2, 'name' => 'Selai Lemon Butter', 'desc' => 'Lemon curd creamy'],
            ['cat' => 2, 'name' => 'Manisan Jeruk Kering', 'desc' => 'Jeruk kering manis'],
            ['cat' => 2, 'name' => 'Dodol Jeruk Garut', 'desc' => 'Dodol rasa jeruk khas Garut'],
            ['cat' => 2, 'name' => 'Permen Jeruk Nipis', 'desc' => 'Permen rasa jeruk nipis'],
            ['cat' => 2, 'name' => 'Sirup Jeruk Asli', 'desc' => 'Sirup jeruk tanpa pewarna'],
            ['cat' => 2, 'name' => 'Selai Jeruk Bali', 'desc' => 'Selai dari jeruk Bali merah'],
            ['cat' => 2, 'name' => 'Orange Preserve', 'desc' => 'Jeruk dalam sirup'],
            ['cat' => 2, 'name' => 'Lemon Curd Premium', 'desc' => 'Lemon curd import quality'],
            ['cat' => 2, 'name' => 'Manisan Kulit Jeruk', 'desc' => 'Kulit jeruk manisan'],
            ['cat' => 2, 'name' => 'Selai Jeruk Low Sugar', 'desc' => 'Selai jeruk rendah gula'],
            ['cat' => 2, 'name' => 'Orange Chutney', 'desc' => 'Chutney jeruk pedas manis'],
            ['cat' => 2, 'name' => 'Jeruk Kering Organik', 'desc' => 'Irisan jeruk kering organik'],
            ['cat' => 2, 'name' => 'Selai Jeruk Mandarin', 'desc' => 'Selai dari jeruk mandarin'],
            
            // Paket Hadiah (15 products)
            ['cat' => 3, 'name' => 'Paket Jeruk Premium 5kg', 'desc' => 'Paket jeruk premium dalam box'],
            ['cat' => 3, 'name' => 'Hampers Jeruk Lebaran', 'desc' => 'Hampers jeruk untuk lebaran'],
            ['cat' => 3, 'name' => 'Gift Box Jeruk Sunkist', 'desc' => 'Box hadiah jeruk sunkist'],
            ['cat' => 3, 'name' => 'Parcel Jeruk Imlek', 'desc' => 'Parcel jeruk untuk imlek'],
            ['cat' => 3, 'name' => 'Paket Jeruk Natal', 'desc' => 'Paket jeruk spesial natal'],
            ['cat' => 3, 'name' => 'Hampers Jeruk Wedding', 'desc' => 'Hampers jeruk untuk pernikahan'],
            ['cat' => 3, 'name' => 'Gift Set Jeruk Organik', 'desc' => 'Set hadiah jeruk organik'],
            ['cat' => 3, 'name' => 'Paket Jeruk Corporate', 'desc' => 'Paket jeruk untuk korporat'],
            ['cat' => 3, 'name' => 'Hampers Jeruk Luxury', 'desc' => 'Hampers jeruk mewah'],
            ['cat' => 3, 'name' => 'Gift Box Mix Citrus', 'desc' => 'Box campuran berbagai jeruk'],
            ['cat' => 3, 'name' => 'Paket Jeruk Keluarga', 'desc' => 'Paket jeruk untuk keluarga'],
            ['cat' => 3, 'name' => 'Hampers Jeruk Premium', 'desc' => 'Hampers jeruk premium'],
            ['cat' => 3, 'name' => 'Gift Set Jeruk Import', 'desc' => 'Set jeruk import pilihan'],
            ['cat' => 3, 'name' => 'Paket Jeruk Spesial', 'desc' => 'Paket jeruk edisi spesial'],
            ['cat' => 3, 'name' => 'Hampers Jeruk Eksklusif', 'desc' => 'Hampers jeruk eksklusif'],
            
            // Produk Organik (15 products)
            ['cat' => 4, 'name' => 'Jeruk Organik Bersertifikat', 'desc' => 'Jeruk organik bersertifikat'],
            ['cat' => 4, 'name' => 'Lemon Organik Premium', 'desc' => 'Lemon organik tanpa pestisida'],
            ['cat' => 4, 'name' => 'Jeruk Nipis Organik', 'desc' => 'Jeruk nipis organik segar'],
            ['cat' => 4, 'name' => 'Jeruk Bali Organik', 'desc' => 'Jeruk Bali organik alami'],
            ['cat' => 4, 'name' => 'Mandarin Organik', 'desc' => 'Jeruk mandarin organik'],
            ['cat' => 4, 'name' => 'Jeruk Kintamani Organik', 'desc' => 'Jeruk organik dari Kintamani'],
            ['cat' => 4, 'name' => 'Orange Organik Import', 'desc' => 'Jeruk organik import'],
            ['cat' => 4, 'name' => 'Jeruk Purut Organik', 'desc' => 'Jeruk purut organik'],
            ['cat' => 4, 'name' => 'Lemon Grass Organik', 'desc' => 'Sereh organik segar'],
            ['cat' => 4, 'name' => 'Jeruk Siam Organik', 'desc' => 'Jeruk siam organik manis'],
            ['cat' => 4, 'name' => 'Citrus Mix Organik', 'desc' => 'Campuran jeruk organik'],
            ['cat' => 4, 'name' => 'Jeruk Lokal Organik', 'desc' => 'Jeruk lokal organik pilihan'],
            ['cat' => 4, 'name' => 'Lemon Organik Lokal', 'desc' => 'Lemon organik lokal'],
            ['cat' => 4, 'name' => 'Jeruk Keprok Organik', 'desc' => 'Jeruk keprok organik'],
            ['cat' => 4, 'name' => 'Orange Juice Organik', 'desc' => 'Jus jeruk organik murni'],
            
            // Snack Jeruk (15 products)
            ['cat' => 5, 'name' => 'Keripik Kulit Jeruk', 'desc' => 'Keripik dari kulit jeruk'],
            ['cat' => 5, 'name' => 'Permen Jeruk Asam', 'desc' => 'Permen rasa jeruk asam'],
            ['cat' => 5, 'name' => 'Coklat Isi Jeruk', 'desc' => 'Coklat dengan isi jeruk'],
            ['cat' => 5, 'name' => 'Wafer Rasa Jeruk', 'desc' => 'Wafer rasa jeruk crispy'],
            ['cat' => 5, 'name' => 'Biskuit Jeruk Nipis', 'desc' => 'Biskuit rasa jeruk nipis'],
            ['cat' => 5, 'name' => 'Candy Orange Blast', 'desc' => 'Permen jeruk meledak'],
            ['cat' => 5, 'name' => 'Gummy Bear Jeruk', 'desc' => 'Gummy bear rasa jeruk'],
            ['cat' => 5, 'name' => 'Lollipop Jeruk', 'desc' => 'Lollipop rasa jeruk'],
            ['cat' => 5, 'name' => 'Chocolate Orange', 'desc' => 'Coklat jeruk premium'],
            ['cat' => 5, 'name' => 'Kue Kering Jeruk', 'desc' => 'Kue kering rasa jeruk'],
            ['cat' => 5, 'name' => 'Nastar Jeruk', 'desc' => 'Nastar dengan selai jeruk'],
            ['cat' => 5, 'name' => 'Cookies Lemon', 'desc' => 'Cookies rasa lemon'],
            ['cat' => 5, 'name' => 'Cake Jeruk Mini', 'desc' => 'Cake mini rasa jeruk'],
            ['cat' => 5, 'name' => 'Brownies Jeruk', 'desc' => 'Brownies dengan topping jeruk'],
            ['cat' => 5, 'name' => 'Pie Jeruk Lemon', 'desc' => 'Pie lemon segar'],
            
            // Perawatan Kulit (15 products)
            ['cat' => 6, 'name' => 'Sabun Jeruk Nipis', 'desc' => 'Sabun muka jeruk nipis'],
            ['cat' => 6, 'name' => 'Masker Vitamin C Jeruk', 'desc' => 'Masker wajah vitamin C'],
            ['cat' => 6, 'name' => 'Serum Jeruk Brightening', 'desc' => 'Serum pencerah dari jeruk'],
            ['cat' => 6, 'name' => 'Toner Lemon Fresh', 'desc' => 'Toner lemon menyegarkan'],
            ['cat' => 6, 'name' => 'Body Lotion Jeruk', 'desc' => 'Lotion tubuh ekstrak jeruk'],
            ['cat' => 6, 'name' => 'Face Wash Orange', 'desc' => 'Pembersih wajah jeruk'],
            ['cat' => 6, 'name' => 'Scrub Jeruk Nipis', 'desc' => 'Scrub wajah jeruk nipis'],
            ['cat' => 6, 'name' => 'Cream Vitamin C', 'desc' => 'Krim wajah vitamin C jeruk'],
            ['cat' => 6, 'name' => 'Lip Balm Lemon', 'desc' => 'Lip balm rasa lemon'],
            ['cat' => 6, 'name' => 'Hand Cream Jeruk', 'desc' => 'Krim tangan aroma jeruk'],
            ['cat' => 6, 'name' => 'Body Scrub Orange', 'desc' => 'Scrub tubuh jeruk'],
            ['cat' => 6, 'name' => 'Facial Mist Citrus', 'desc' => 'Face mist aroma citrus'],
            ['cat' => 6, 'name' => 'Sunscreen Vitamin C', 'desc' => 'Sunscreen dengan vitamin C'],
            ['cat' => 6, 'name' => 'Night Cream Jeruk', 'desc' => 'Night cream ekstrak jeruk'],
            ['cat' => 6, 'name' => 'Eye Cream Lemon', 'desc' => 'Eye cream lemon'],
            
            // Aromaterapi (15 products)
            ['cat' => 7, 'name' => 'Essential Oil Orange', 'desc' => 'Minyak esensial jeruk'],
            ['cat' => 7, 'name' => 'Lilin Aroma Lemon', 'desc' => 'Lilin aromaterapi lemon'],
            ['cat' => 7, 'name' => 'Diffuser Oil Citrus', 'desc' => 'Minyak diffuser citrus'],
            ['cat' => 7, 'name' => 'Room Spray Jeruk', 'desc' => 'Spray ruangan aroma jeruk'],
            ['cat' => 7, 'name' => 'Potpourri Orange', 'desc' => 'Potpourri aroma jeruk'],
            ['cat' => 7, 'name' => 'Incense Lemon', 'desc' => 'Dupa aroma lemon'],
            ['cat' => 7, 'name' => 'Reed Diffuser Citrus', 'desc' => 'Reed diffuser citrus'],
            ['cat' => 7, 'name' => 'Car Freshener Orange', 'desc' => 'Pengharum mobil jeruk'],
            ['cat' => 7, 'name' => 'Sachet Aroma Jeruk', 'desc' => 'Sachet pengharum jeruk'],
            ['cat' => 7, 'name' => 'Bath Salt Lemon', 'desc' => 'Garam mandi lemon'],
            ['cat' => 7, 'name' => 'Massage Oil Orange', 'desc' => 'Minyak pijat jeruk'],
            ['cat' => 7, 'name' => 'Aromatherapy Set Citrus', 'desc' => 'Set aromaterapi citrus'],
            ['cat' => 7, 'name' => 'Wax Melt Jeruk', 'desc' => 'Wax melt aroma jeruk'],
            ['cat' => 7, 'name' => 'Pillow Spray Lemon', 'desc' => 'Spray bantal lemon'],
            ['cat' => 7, 'name' => 'Air Purifier Orange', 'desc' => 'Pembersih udara jeruk'],
        ];
        
        $products = [];
        $allVariants = [];
        
        foreach ($productsData as $index => $data) {
            $product = Product::create([
                'category_id' => $categories[$data['cat']]->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']) . '-' . ($index + 1),
                'description' => $data['desc'],
                'is_active' => true,
                'total_sold_count' => rand(10, 200),
            ]);
            
            $products[] = $product;
            
            // Create placeholder image
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/placeholder-orange.jpg',
                'is_primary' => true,
            ]);
            
            // Create category-appropriate variants
            // Define variants by category index
            $variantsByCategory = [
                0 => [ // Jeruk Segar (Fresh Oranges) - Weight-based
                    ['name' => '500 gram', 'price' => 15000],
                    ['name' => '1 kilogram', 'price' => 28000],
                    ['name' => '2 kilogram', 'price' => 50000],
                    ['name' => '5 kilogram', 'price' => 115000],
                ],
                1 => [ // Jus & Minuman (Juices & Drinks) - Volume-based
                    ['name' => '250 ml', 'price' => 12000],
                    ['name' => '500 ml', 'price' => 20000],
                    ['name' => '1 liter', 'price' => 35000],
                    ['name' => '2 liter', 'price' => 65000],
                ],
                2 => [ // Selai & Olahan (Jams & Processed) - Jar/Unit-based
                    ['name' => '1 jar (200g)', 'price' => 25000],
                    ['name' => '1 jar (500g)', 'price' => 55000],
                    ['name' => '2 jars (200g)', 'price' => 45000],
                    ['name' => 'Paket 3 jars', 'price' => 65000],
                ],
                3 => [ // Paket Hadiah (Gift Packages) - Set-based
                    ['name' => 'Paket Kecil (2kg)', 'price' => 75000],
                    ['name' => 'Paket Sedang (5kg)', 'price' => 150000],
                    ['name' => 'Paket Besar (10kg)', 'price' => 280000],
                    ['name' => 'Paket Premium (15kg)', 'price' => 400000],
                ],
                4 => [ // Produk Organik (Organic) - Weight-based
                    ['name' => '500 gram', 'price' => 25000],
                    ['name' => '1 kilogram', 'price' => 45000],
                    ['name' => '3 kilogram', 'price' => 120000],
                    ['name' => '5 kilogram', 'price' => 190000],
                ],
                5 => [ // Snack Jeruk (Orange Snacks) - Pack-based
                    ['name' => '1 pack (100g)', 'price' => 15000],
                    ['name' => '3 packs (300g)', 'price' => 40000],
                    ['name' => '5 packs (500g)', 'price' => 65000],
                    ['name' => '10 packs (1kg)', 'price' => 120000],
                ],
                6 => [ // Perawatan Kulit (Skincare) - Volume-based
                    ['name' => '30 ml', 'price' => 45000],
                    ['name' => '50 ml', 'price' => 70000],
                    ['name' => '100 ml', 'price' => 120000],
                    ['name' => 'Paket Hemat (30ml x 3)', 'price' => 120000],
                ],
                7 => [ // Aromaterapi (Aromatherapy) - Volume-based
                    ['name' => '10 ml', 'price' => 35000],
                    ['name' => '30 ml', 'price' => 85000],
                    ['name' => '50 ml', 'price' => 130000],
                    ['name' => 'Set Diffuser (30ml + Reed)', 'price' => 150000],
                ],
            ];
            
            $categoryVariants = $variantsByCategory[$data['cat']];
            
            foreach ($categoryVariants as $v => $variantData) {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_name' => $variantData['name'],
                    'price' => $variantData['price'] + rand(-3000, 5000), // Add some price variation
                    'stock' => rand(20, 100),
                    'sku' => 'JRK-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '-' . ($v + 1),
                ]);
                $allVariants[] = $variant;
            }
        }
        
        echo "✅ 135 produk dibuat!\n\n";
        
        // Create Flash Sale Sessions
        echo "🔥 Membuat flash sale sessions...\n";
        
        $now = Carbon::now();
        $flashSaleSessions = [
            ['start' => $now->copy()->subHours(2), 'end' => $now->copy()->addHours(4), 'count' => 15],
            ['start' => $now->copy()->addHours(6), 'end' => $now->copy()->addHours(12), 'count' => 12],
            ['start' => $now->copy()->addDay()->setHour(10), 'end' => $now->copy()->addDay()->setHour(16), 'count' => 10],
        ];
        
        $flashSaleCount = 0;
        $usedVariantIds = [];
        
        foreach ($flashSaleSessions as $session) {
            $availableVariants = collect($allVariants)->filter(function($variant) use ($usedVariantIds) {
                return !in_array($variant->id, $usedVariantIds);
            });
            
            $sessionVariants = $availableVariants->random(min($session['count'], $availableVariants->count()));
            
            foreach ($sessionVariants as $variant) {
                $discount = rand(20, 50);
                $flashPrice = $variant->price * (100 - $discount) / 100;
                
                FlashSale::create([
                    'product_variant_id' => $variant->id,
                    'original_price' => $variant->price,
                    'flash_price' => $flashPrice,
                    'discount_percentage' => $discount,
                    'flash_stock' => rand(10, 30),
                    'flash_sold' => rand(0, 10),
                    'start_time' => $session['start'],
                    'end_time' => $session['end'],
                    'is_active' => true,
                ]);
                
                $usedVariantIds[] = $variant->id;
                $flashSaleCount++;
            }
        }
        
        echo "✅ {$flashSaleCount} flash sale dibuat!\n\n";
        
        // Create Orders and Reviews
        echo "📦 Membuat pesanan dan review...\n";
        
        $orderCount = 0;
        $reviewCount = 0;
        
        foreach ($members as $member) {
            $numOrders = rand(3, 8);
            
            for ($o = 0; $o < $numOrders; $o++) {
                $order = Order::create([
                    'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                    'user_id' => $member->id,
                    'guest_name' => $member->name,
                    'guest_email' => $member->email,
                    'guest_phone' => '08' . rand(1000000000, 9999999999),
                    'guest_address' => 'Jl. ' . ['Merdeka', 'Sudirman', 'Thamrin', 'Gatot Subroto'][rand(0, 3)] . ' No. ' . rand(1, 100),
                    'subtotal' => 0,
                    'shipping_cost' => rand(10000, 30000),
                    'total' => 0,
                    'status' => ['delivered', 'shipped'][rand(0, 1)],
                    'created_at' => $now->copy()->subDays(rand(1, 60)),
                ]);
                
                $numItems = rand(1, 4);
                $subtotal = 0;
                
                for ($i = 0; $i < $numItems; $i++) {
                    $variant = $allVariants[rand(0, count($allVariants) - 1)];
                    $quantity = rand(1, 3);
                    $price = $variant->price;
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
                        'product_name' => $variant->product->name,
                        'variant_name' => $variant->variant_name,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                    
                    $subtotal += $price * $quantity;
                    
                    // Update product sold count
                    $variant->product->increment('total_sold_count', $quantity);
                }
                
                $total = $subtotal + $order->shipping_cost;
                $order->update(['subtotal' => $subtotal, 'total' => $total]);
                $orderCount++;
                
                // Create review for some orders
                if (rand(0, 100) > 30 && $order->status === 'delivered') {
                    $orderItems = $order->orderItems;
                    foreach ($orderItems as $item) {
                        if (rand(0, 100) > 50) {
                            Review::create([
                                'user_id' => $member->id,
                                'product_id' => $item->productVariant->product_id,
                                'order_item_id' => $item->id,
                                'rating' => rand(4, 5),
                                'comment' => [
                                    'Produk sangat bagus dan segar!',
                                    'Pengiriman cepat, jeruknya manis',
                                    'Recommended seller, pasti order lagi',
                                    'Kualitas premium, harga terjangkau',
                                    'Jeruknya fresh dan besar-besar',
                                ][rand(0, 4)],
                            ]);
                            $reviewCount++;
                        }
                    }
                }
            }
        }
        
        echo "✅ {$orderCount} pesanan dibuat!\n";
        echo "✅ {$reviewCount} review dibuat!\n\n";
        
        echo "🎉 SELESAI! Data Indonesia Fresh:\n";
        echo "   - 8 kategori\n";
        echo "   - 135 produk\n";
        echo "   - 540 varian (4 per produk, sesuai kategori)\n";
        echo "   - {$flashSaleCount} flash sale (3 sessions)\n";
        echo "   - {$orderCount} pesanan\n";
        echo "   - {$reviewCount} review\n";
        echo "   - 12 member\n";
        echo "   - 1 admin\n\n";
    }
}
