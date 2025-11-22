<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RealJerukPinSeeder extends Seeder
{
    public function run(): void
    {
        // Clear all existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductImage::truncate();
        ProductVariant::truncate();
        Product::truncate();
        Category::truncate();
        DB::table('cart_items')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('flash_sales')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ensure admin exists
        User::firstOrCreate(
            ['email' => 'admin@jerukpin.com'],
            [
                'name' => 'Admin JerukPin',
                'phone' => '081234567890',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ]
        );

        // Create Categories with Rich Descriptions
        $categories = [
            [
                'name' => 'Es Jeruk Lokal',
                'slug' => 'es-jeruk-lokal',
                'description' => 'Kesegaran otentik dari kebun nusantara. Jeruk lokal pilihan dengan karakter rasa manis-asam yang khas, membangkitkan semangat di setiap tegukan.',
                'image' => 'categories/es-jeruk-lokal.png'
            ],
            [
                'name' => 'Es Jeruk Sunkist',
                'slug' => 'es-jeruk-sunkist',
                'description' => 'Kemewahan rasa jeruk premium. Sunkist impor dengan bulir bulir segar yang meletup di mulut, menghadirkan sensasi manis yang elegan dan menyegarkan.',
                'image' => 'categories/es-jeruk-sunkist.png'
            ],
            [
                'name' => 'Es Lemon',
                'slug' => 'es-lemon',
                'description' => 'Ledakan vitamin C yang menyegarkan. Lemon segar pilihan yang diperas sempurna, memberikan sensasi "zing" yang membersihkan dahaga seketika.',
                'image' => 'categories/es-lemon.png'
            ],
        ];

        foreach ($categories as $categoryData) {
            // Handle image separately as it's not in the fillable/schema yet (we'll assume we add it or use a placeholder logic in view)
            // For now, we'll store it but the model might need updating if we want to save it in DB. 
            // Actually, let's just create the category first.
            Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
            ]);
        }

        // Product Data with Gen-Z "Alay" Style Descriptions
        $productsData = [
            // Es Jeruk Lokal
            [
                'category' => 'Es Jeruk Lokal',
                'name' => 'Es Jeruk Original',
                'price' => 5000,
                'description' => "Guys, ini dia minuman legendaris yang bikin kangen masa kecil! 🍊✨ Es Jeruk Original kita tuh asli pake jeruk lokal Pontianak yang dipetik pas lagi prime time! No caplang-caplang, purely jeruk asli yang di-press langsung.\n\nVibe-nya simple tapi NYESS banget! Rasa manis asamnya tuh pas di lidah, ga lebay, ga kemanisan, pokoknya balance perfecto. Ice-nya juga crispy gitu, bikin seger maksimal pas lagi gerah-gerahnya. Literally minuman comfort yang bikin hati adem, perut happy! 💯🧊\n\nPerfect buat yang lagi galau, lagi happy, atau lagi pengen sesuatu yang natural vibe. Main character energy banget dah pokoknya! 🌟",
                'images' => ['es-jeruk-original-1.png', 'es-jeruk-original-2.png', 'es-jeruk-original-3.png', 'es-jeruk-original-4.png', 'es-jeruk-original-5.png']
            ],
            [
                'category' => 'Es Jeruk Lokal',
                'name' => 'Es Jeruk Susu',
                'price' => 7000,
                'description' => "OMG! Ini tuh literally hug in a cup! 🤗🧡 Bayangin jeruk segar ketemu sama susu creamy, terus mereka jadian dan bikin kesempurnaan! Warnanya aesthetic banget, gradasi orange-white yang auto bikin feed IG kamu glowing!\n\nSeriously, ini minuman yang bakal bikin kamu jatuh cinta dari sip pertama. Creamy tapi fresh, sweet tapi ada kick asem-asemnya dikit. Teksturnya smooth banget kayak lagi minum dessert cair! 🍨💕\n\nCocok banget buat kamu yang suka minuman yang playful dan ga boring. Dijamin bakal jadi favorite drink kamu selamanya! Trust the process, trust Es Jeruk Susu! 🎀",
                'images' => ['es-jeruk-susu-1.png', 'es-jeruk-susu-2.png', 'es-jeruk-susu-3.png', 'es-jeruk-susu-4.png', 'es-jeruk-susu-5.png']
            ],
            [
                'category' => 'Es Jeruk Lokal',
                'name' => 'Es Jeruk Madu',
                'price' => 7000,
                'description' => "Healthy queen spotted! 👑🐝 Es Jeruk Madu ini bener-bener the IT girl of healthy drinks. Perpaduan jeruk yang kaya vitamin C sama madu hutan yang organic, bikin minuman ini jadi power couple goals!\n\nRasanya? Glow up banget! Manis madu yang natural banget mellow-in sama keasaman jeruk, bikin harmoni yang chef's kiss! 😘✨ Plus ada aroma floral gitu yang calming banget, instant mood booster deh!\n\nBuat kamu yang sayang badan tapi tetep pengen yang enak, ini pilihan paling tepat! Boost energi, boost imun, boost vibes - all in one glass! Self-care never taste this good! 💪🌈",
                'images' => ['es-jeruk-madu-1.png', 'es-jeruk-madu-2.png', 'es-jeruk-madu-3.png', 'es-jeruk-madu-4.png', 'es-jeruk-madu-5.png']
            ],
            
            // Es Jeruk Sunkist
            [
                'category' => 'Es Jeruk Sunkist',
                'name' => 'Es Sunkist Original',
                'price' => 7000,
                'description' => "Premium vibes only! 💎🍊 Es Sunkist Original ini bukan jeruk sembarangan, bestie! Pake Sunkist import yang warnanya aja udah bikin mata melek - orange super cerah yang vibrant abis!\n\nTaste-wise? SUPERIOR! Lebih manis, lebih aromatic, lebih everything yang bikin kamu merasa fancy! Rasanya ringan tapi flavor-packed, aftertaste-nya clean gitu, zero guilty feeling! 🌟✨\n\nKalo kamu tipe orang yang appreciate the finer things in life, minuman ini tuh literally made for you! Sunkist supremacy is real! 👑💯",
                'images' => ['es-sunkist-original-1.png', 'es-sunkist-original-2.png', 'es-sunkist-original-3.png', 'es-sunkist-original-4.png', 'es-sunkist-original-5.png']
            ],
            [
                'category' => 'Es Jeruk Sunkist',
                'name' => 'Es Sunkist Susu',
                'price' => 8000,
                'description' => "STOP SCROLLING! 📱✨ Ini dia minuman paling aesthetic sedunia! Es Sunkist Susu dengan warna pastel orange yang SO pretty, bikin kamu pengen foto dulu sebelum minum! 100% Instagram-worthy, no filter needed! 📸🎀\n\nTapi bukan cuma cantik doang ya bestie! Rasanya tuh INSANE! Sunkist yang sweet ketemu susu yang creamy, literally taste like creamsicle premium edition! Smooth, luxurious, bikin lidah happy dance! 💃🏻🧡\n\nKalo kamu sophisticated gang tapi tetep suka yang fresh-fresh, THIS IS YOUR DRINK! Main character drink for main character energy! ⭐💫",
                'images' => ['es-sunkist-susu-1.png', 'es-sunkist-susu-2.png', 'es-sunkist-susu-3.png', 'es-sunkist-susu-4.png', 'es-sunkist-susu-5.png']
            ],
            [
                'category' => 'Es Jeruk Sunkist',
                'name' => 'Es Sunkist Madu',
                'price' => 8000,
                'description' => "Golden hours deserve golden drinks! ✨🍯 Es Sunkist Madu ini literally minuman sultan! Warna keemasan yang glowing, taste yang luxurious, vibes yang exclusive - ini tuh premium in every sip!\n\nRasa manis madu yang rich banget nge-elevate citrus vibes dari Sunkist sampe ke another level! Smooth di tenggorokan, soothing banget, bikin kamu auto relax mode on! 🌅💛\n\nPerfect buat yang mau pamper yourself after hustling all day! Because you deserve the best, bestie! Treat yourself like royalty! 👑✨",
                'images' => ['es-sunkist-madu-1.png', 'es-sunkist-madu-2.png', 'es-sunkist-madu-3.png', 'es-sunkist-madu-4.png', 'es-sunkist-madu-5.png']
            ],
            
            // Es Lemon
            [
                'category' => 'Es Lemon',
                'name' => 'Es Lemon Original',
                'price' => 7000,
                'description' => "WAKE UP CALL! ⚡🍋 Es Lemon Original adalah ultimate weapon buat ngusir ngantuk dan bad vibes! Rasa asamnya tuh NENDANG BANGET, bikin senses kamu langsung full mode active!\n\nFresh pressed lemon yang super aromatic, balanced sama gula cair just enough buat ngangkat rasa natural lemonnya. Tajam, clean, instantly refreshing! No joke, ini tuh energy drink versi natural! 💥✨\n\nBuat yang lagi butuh extra boost atau lagi kepanasan minta ampun, minuman ini tuh life saver banget! One sip aja langsung full battery! 🔋🌟",
                'images' => ['es-lemon-original-1.png', 'es-lemon-original-2.png', 'es-lemon-original-3.png', 'es-lemon-original-4.png', 'es-lemon-original-5.png']
            ],
            [
                'category' => 'Es Lemon',
                'name' => 'Es Lemon Susu',
                'price' => 8000,
                'description' => "Plot twist yang nobody expected! 🤯💛 Lemon + Susu = PERFECTION?! Yes bestie, it's real and it's SPECTACULAR! Ini literally the most unexpected collab yang actually works!\n\nKeasaman lemon yang galak di-tame sama creamy susu, hasilnya? Rasa unik yang kayak yogurt drink atau lemon cheesecake dalam bentuk minuman! Creamy, tangy, absolutely mind-blowing! 🎉🍰\n\nKalo kamu adventurous soul yang suka explore rasa-rasa baru, THIS IS YOUR SIGN! Break the rules, try the unusual, live your best life! 🌈✨",
                'images' => ['es-lemon-susu-1.png', 'es-lemon-susu-2.png', 'es-lemon-susu-3.png', 'es-lemon-susu-4.png', 'es-lemon-susu-5.png']
            ],
            [
                'category' => 'Es Lemon',
                'name' => 'Es Lemon Madu',
                'price' => 8000,
                'description' => "The OG wellness drink! 🌿💚 Honey Lemon tuh literally resep nenek-nenek yang timeless! Tapi kita serve it cold, fresh, dan super refreshing! Ancient wisdom meets modern vibes! ✨🍋\n\nLemon yang loaded dengan antioxidants ketemu madu yang super nutritious, bikin minuman detox yang actually ENAK! Balance antara sour dan sweet, literally perfect harmony! 🎵💛\n\nDetox never taste this good, bestie! Bukan cuma nyegerin throat, tapi bikin badan berasa lighter dan lebih sehat! Glow from within energy! That's the power of Es Lemon Madu! 🌟💪",
                'images' => ['es-lemon-madu-1.png', 'es-lemon-madu-2.png', 'es-lemon-madu-3.png', 'es-lemon-madu-4.png', 'es-lemon-madu-5.png']
            ],
        ];

        foreach ($productsData as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            
            $product = Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => \Illuminate\Support\Str::slug($productData['name']),
                'description' => $productData['description'],
                'is_active' => true,
            ]);

            // Create variants
            $variants = [
                ['name' => 'Regular', 'price' => $productData['price'], 'stock' => 100],
                ['name' => 'Dengan Nata de Coco', 'price' => $productData['price'] + 1000, 'stock' => 100]
            ];

            foreach ($variants as $variantData) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_name' => $variantData['name'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                    'sku' => 'JP-' . str_pad($product->id, 3, '0', STR_PAD_LEFT) . '-' . ($variantData['name'] === 'Regular' ? 'REG' : 'NATA'),
                ]);
            }

            // Create Multiple Images
            foreach ($productData['images'] as $index => $imagePath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/' . $imagePath,
                    'is_primary' => $index === 0, // First image is primary
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
