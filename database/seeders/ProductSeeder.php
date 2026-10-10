<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\StockMovement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat beberapa Supplier menggunakan Factory
        $suppliers = Supplier::factory(3)->create();

        // 2. Buat Kategori Manual agar namanya sesuai dengan web A'ritza
        $categoriesData = ['Handbags', 'Accessories', 'Footwear', 'Fine Jewelry'];
        $categories = [];
        foreach ($categoriesData as $catName) {
            $categories[$catName] = Category::create(['name' => $catName]);
        }

        // 3. Data Produk A'ritza
        $productsData = [
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

        // Dapatkan Admin untuk histori stok
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        foreach ($productsData as $index => $data) {
            $catName = $data['category'];
            unset($data['category']);
            
            $data['category_id'] = $categories[$catName]->id;
            $data['sku'] = 'ARTZ-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            
            $product = Product::create($data);

            // Hubungkan dengan Supplier secara acak
            $product->suppliers()->attach(
                $suppliers->random(rand(1, 2))->pluck('id')->toArray(),
                ['supplier_price' => $data['price'] * 0.6] // Asumsi harga modal 60%
            );

            // Buat Histori Barang Masuk Awal
            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $admin->id,
                'type' => 'IN',
                'quantity' => $data['stock'],
                'notes' => 'Initial stock seed'
            ]);
        }
        
        // Buat tambahan 15 Produk dari Factory secara acak
        Product::factory(15)->create()->each(function ($product) use ($suppliers, $admin) {
            $product->suppliers()->attach(
                $suppliers->random(rand(1, 2))->pluck('id')->toArray(),
                ['supplier_price' => $product->price * 0.6]
            );

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $admin->id,
                'type' => 'IN',
                'quantity' => $product->stock,
                'notes' => 'Random factory stock'
            ]);
        });
    }
}
