<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'A\'ritza Signature Tote',
                'category' => 'Handbags',
                'price' => 35000000.00,
                'stock' => 12,
            ],
            [
                'name' => 'Monogram Leather Satchel',
                'category' => 'Handbags',
                'price' => 28500000.00,
                'stock' => 8,
            ],
            [
                'name' => 'Classic Quilted Flap Bag',
                'category' => 'Handbags',
                'price' => 45000000.00,
                'stock' => 3,
            ],
            [
                'name' => 'Silk Chiffon Evening Scarf',
                'category' => 'Accessories',
                'price' => 8500000.00,
                'stock' => 25,
            ],
            [
                'name' => 'Gold-Plated Cuff Bracelet',
                'category' => 'Accessories',
                'price' => 12000000.00,
                'stock' => 15,
            ],
            [
                'name' => 'A\'ritza Aviator Sunglasses',
                'category' => 'Accessories',
                'price' => 7800000.00,
                'stock' => 30,
            ],
            [
                'name' => 'Crocodile Embossed Loafers',
                'category' => 'Footwear',
                'price' => 15500000.00,
                'stock' => 10,
            ],
            [
                'name' => 'Velvet Stiletto Heels',
                'category' => 'Footwear',
                'price' => 18900000.00,
                'stock' => 5,
            ],
            [
                'name' => 'Diamond Pave Drop Earrings',
                'category' => 'Fine Jewelry',
                'price' => 125000000.00,
                'stock' => 2,
            ],
            [
                'name' => '18K Gold Chain Necklace',
                'category' => 'Fine Jewelry',
                'price' => 85000000.00,
                'stock' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
