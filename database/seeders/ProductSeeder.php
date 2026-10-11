<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

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
                'image' => 'products/signature_tote.jpg',
            ],
            [
                'name' => 'Monogram Leather Satchel',
                'category' => 'Handbags',
                'price' => 28500000.00,
                'stock' => 8,
                'image' => 'products/monogram_satchel.jpg',
            ],
            [
                'name' => 'Classic Quilted Flap Bag',
                'category' => 'Handbags',
                'price' => 45000000.00,
                'stock' => 3,
                'image' => 'products/quilted_flap_bag.jpg',
            ],
            [
                'name' => 'Silk Chiffon Evening Scarf',
                'category' => 'Accessories',
                'price' => 8500000.00,
                'stock' => 25,
                'image' => 'products/silk_scarf.jpg',
            ],
            [
                'name' => 'Gold-Plated Cuff Bracelet',
                'category' => 'Accessories',
                'price' => 12000000.00,
                'stock' => 15,
                'image' => 'products/gold_cuff_bracelet.jpg',
            ],
            [
                'name' => 'A\'ritza Aviator Sunglasses',
                'category' => 'Accessories',
                'price' => 7800000.00,
                'stock' => 30,
                'image' => 'products/aviator_sunglasses.jpg',
            ],
            [
                'name' => 'Crocodile Embossed Loafers',
                'category' => 'Footwear',
                'price' => 15500000.00,
                'stock' => 10,
                'image' => 'products/crocodile_loafers.jpg',
            ],
            [
                'name' => 'Velvet Stiletto Heels',
                'category' => 'Footwear',
                'price' => 18900000.00,
                'stock' => 5,
                'image' => 'products/velvet_heels.jpg',
            ],
            [
                'name' => 'Diamond Pave Drop Earrings',
                'category' => 'Fine Jewelry',
                'price' => 125000000.00,
                'stock' => 2,
                'image' => 'products/diamond_earrings.jpg',
            ],
            [
                'name' => '18K Gold Chain Necklace',
                'category' => 'Fine Jewelry',
                'price' => 85000000.00,
                'stock' => 4,
                'image' => 'products/gold_chain_necklace.jpg',
            ],
        ];

        // Dapatkan Admin untuk histori stok
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        foreach ($productsData as $index => $data) {
            $catName = $data['category'];
            unset($data['category']);

            $data['category_id'] = $categories[$catName]->id;
            $data['sku'] = 'ARTZ-'.str_pad($index + 1, 4, '0', STR_PAD_LEFT);

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
                'notes' => 'Initial stock seed',
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
                'notes' => 'Random factory stock',
            ]);
        });
    }
}
