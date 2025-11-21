<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Jeruk Segar',
                'slug' => 'jeruk-segar',
                'description' => 'Berbagai jenis jeruk segar pilihan dengan kualitas terbaik',
                'is_active' => true,
            ],
            [
                'name' => 'Paket Gift Box',
                'slug' => 'paket-gift-box',
                'description' => 'Paket jeruk dalam kemasan gift box eksklusif, cocok untuk hadiah',
                'is_active' => true,
            ],
            [
                'name' => 'Produk Organik',
                'slug' => 'produk-organik',
                'description' => 'Jeruk organik tanpa pestisida, sehat dan alami',
                'is_active' => true,
            ],
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
        
        $this->command->info('3 categories created successfully!');
    }
}
