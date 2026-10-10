<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $categoryName) {
                $query->whereHas('category', function ($q) use ($categoryName) {
                    $q->where('name', $categoryName);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->withQueryString();

        return \Inertia\Inertia::render('Products/Index', [
            'products' => $products,
            'filters' => $request->only(['search', 'category'])
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Products/Create', [
            'categories' => \App\Models\Category::all()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        DB::beginTransaction();
        try {
            $product = Product::create($data);

            if ($product->stock > 0) {
                StockMovement::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'type' => 'IN',
                    'quantity' => $product->stock,
                    'notes' => 'Initial stock addition'
                ]);
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Piece added to collection successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error saving product: ' . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return \Inertia\Inertia::render('Products/Edit', [
            'product' => $product,
            'categories' => \App\Models\Category::all()
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        DB::beginTransaction();
        try {
            $oldStock = $product->stock;
            $product->update($data);
            $newStock = $product->stock;

            if ($newStock != $oldStock) {
                $difference = $newStock - $oldStock;
                StockMovement::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'type' => $difference > 0 ? 'IN' : 'OUT',
                    'quantity' => abs($difference),
                    'notes' => 'Manual stock adjustment'
                ]);
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Piece updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        if ($product->stockMovements()->count() > 0) {
            return back()->with('error', 'Cannot remove piece: It has transaction history.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Piece removed from collection.');
    }
}
