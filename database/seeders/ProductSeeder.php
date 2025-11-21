<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get categories
        $jerukSegar = Category::where('slug', 'jeruk-segar')->first();
        $giftBox = Category::where('slug', 'paket-gift-box')->first();
        $organik = Category::where('slug', 'produk-organik')->first();
        
        // Product 1: Jeruk Madu Premium
        $product1 = Product::create([
            'category_id' => $jerukSegar->id,
            'name' => 'Jeruk Madu Premium',
            'slug' => 'jeruk-madu-premium',
            'description' => 'Jeruk madu premium dengan rasa manis alami dan segar. Kaya vitamin C dan cocok untuk konsumsi sehari-hari.',
            'is_active' => true,
            'total_sold_count' => 127, // Best seller
        ]);
        
        ProductVariant::create([
            'product_id' => $product1->id,
            'variant_name' => '1 kg',
            'sku' => 'JM-1KG',
            'price' => 25000,
            'stock' => 100,
            'sold_count' => 45,
            'sort_order' => 1,
            'is_active' => true,
        ]);
        
        ProductVariant::create([
            'product_id' => $product1->id,
            'variant_name' => '5 kg',
            'sku' => 'JM-5KG',
            'price' => 115000,
            'stock' => 50,
            'sold_count' => 62,
            'sort_order' => 2,
            'is_active' => true,
        ]);
        
        ProductVariant::create([
            'product_id' => $product1->id,
            'variant_name' => '10 kg',
            'sku' => 'JM-10KG',
            'price' => 220000,
            'stock' => 30,
            'sold_count' => 20,
            'sort_order' => 3,
            'is_active' => true,
        ]);
        
        // Product 2: Jeruk Nipis Segar
        $product2 = Product::create([
            'category_id' => $jerukSegar->id,
            'name' => 'Jeruk Nipis Segar',
            'slug' => 'jeruk-nipis-segar',
            'description' => 'Jeruk nipis segar dengan aroma khas. Cocok untuk bumbu masakan, minuman, dan perawatan kesehatan.',
            'is_active' => true,
            'total_sold_count' => 89,
        ]);
        
        ProductVariant::create([
            'product_id' => $product2->id,
            'variant_name' => '500 gram',
            'sku' => 'JN-500G',
            'price' => 15000,
            'stock' => 80,
            'sold_count' => 52,
            'sort_order' => 1,
            'is_active' => true,
        ]);
        
        ProductVariant::create([
            'product_id' => $product2->id,
            'variant_name' => '1 kg',
            'sku' => 'JN-1KG',
            'price' => 28000,
            'stock' => 60,
            'sold_count' => 37,
            'sort_order' => 2,
            'is_active' => true,
        ]);
        
        // Product 3: Gift Box Spesial
        $product3 = Product::create([
            'category_id' => $giftBox->id,
            'name' => 'Gift Box Spesial',
            'slug' => 'gift-box-spesial',
            'description' => 'Paket gift box berisi jeruk pilihan dalam kemasan eksklusif. Cocok untuk hadiah spesial dan hampers.',
            'is_active' => true,
            'total_sold_count' => 43,
        ]);
        
        ProductVariant::create([
            'product_id' => $product3->id,
            'variant_name' => 'Paket A (2 kg)',
            'sku' => 'GB-PKT-A',
            'price' => 85000,
            'stock' => 25,
            'sold_count' => 18,
            'sort_order' => 1,
            'is_active' => true,
        ]);
        
        ProductVariant::create([
            'product_id' => $product3->id,
            'variant_name' => 'Paket B (5 kg)',
            'sku' => 'GB-PKT-B',
            'price' => 195000,
            'stock' => 15,
            'sold_count' => 25,
            'sort_order' => 2,
            'is_active' => true,
        ]);
        
        // Product 4: Jeruk Keprok Organik
        $product4 = Product::create([
            'category_id' => $organik->id,
            'name' => 'Jeruk Keprok Organik',
            'slug' => 'jeruk-keprok-organik',
            'description' => 'Jeruk keprok organik tanpa pestisida. Ditanam dengan metode alami untuk kesehatan keluarga.',
            'is_active' => true,
            'total_sold_count' => 67,
        ]);
        
        ProductVariant::create([
            'product_id' => $product4->id,
            'variant_name' => '1 kg',
            'sku' => 'JKO-1KG',
            'price' => 35000,
            'stock' => 40,
            'sold_count' => 38,
            'sort_order' => 1,
            'is_active' => true,
        ]);
        
        ProductVariant::create([
            'product_id' => $product4->id,
            'variant_name' => '3 kg',
            'sku' => 'JKO-3KG',
            'price' => 98000,
            'stock' => 20,
            'sold_count' => 29,
            'sort_order' => 2,
            'is_active' => true,
        ]);
        
        // Product 5: Jeruk Santang Manis
        $product5 = Product::create([
            'category_id' => $jerukSegar->id,
            'name' => 'Jeruk Santang Manis',
            'slug' => 'jeruk-santang-manis',
            'description' => 'Jeruk santang dengan rasa manis khas. Ukuran besar dan daging buah tebal.',
            'is_active' => true,
            'total_sold_count' => 34,
        ]);
        
        ProductVariant::create([
            'product_id' => $product5->id,
            'variant_name' => '1 kg',
            'sku' => 'JS-1KG',
            'price' => 30000,
            'stock' => 50,
            'sold_count' => 22,
            'sort_order' => 1,
            'is_active' => true,
        ]);
        
        ProductVariant::create([
            'product_id' => $product5->id,
            'variant_name' => '2 kg',
            'sku' => 'JS-2KG',
            'price' => 58000,
            'stock' => 30,
            'sold_count' => 12,
            'sort_order' => 2,
            'is_active' => true,
        ]);
        
        $this->command->info('5 products with variants created successfully!');
        $this->command->info('Total variants: 13');
    }
}
