<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;

class ProductController extends Controller
{

    //Home method
    public function home()
    {
        //Fetch all products with their categories
        $products = Product::with('categories')->paginate(12);
        $categories = Category::all();

        return view('welcome', compact('products', 'categories'));
    }

    //Fetch and display a product with its variants and categories
    public function show($productId)
    {
        //Views the product variants by id
        $product = Product::with(['variants', 'categories'])->findOrFail($productId);
        return view('product', compact('product'));

    }

    public function index(Request $request)
    {
        $query = Product::with('categories');

        //Filter by category if requested
        if($request->has('category')) {

            $query->whereHas('categories', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        if($request->category == 'All')
        {
            return redirect()->action([ProductController::class, 'home']);
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('welcome', compact('products', 'categories'));
    }

    //Delete a product by id
    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        $products = Product::with('categories')->get();
        return view('welcome', compact('products'))->with('success', 'Product deleted successfully.');
    }

    //Add a product
    public function addProduct(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'variants.*.variantname' => 'string|max:255',
        'variants' => 'required|array|min:1',
        'variants.*.price' => 'required|numeric|min:0',
        'variants.*.stock' => 'required|integer|min:1',
    ]);

    // Create the product
    $product = Product::create([
        'name' => $validated['name'],
    ]);

    // Create variants
    foreach ($validated['variants'] as $variantData) {
        $product->variants()->create([
            'name' => $variantData['variantname'],
            'price' => $variantData['price'],
            'stock' => $variantData['stock'] ?? 0,
        ]);
    }

    //Add categories if provided
        $product->categories()->sync($request->input('categories'));

        return view('manage')->with('success', 'Product created successfully');
    }

    //Edit a product
    public function editProduct($productId)
    {
        $product = Product::with('variants')->findOrFail($productId);
        $categories = \App\Models\Category::all();

        return view('updateProduct', compact('product', 'categories'));
    }

    //Update a product
    public function updateProduct(Request $request, $productId)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'variants.*.variantname' => 'string|max:255',
            'variants' => 'array|min:1',
            'variants.*.id' => 'nullable|exists:variants,id,product_id,'.$productId,
            'variants.*.price' => 'nullable|numeric|min:1',
            'variants.*.stock' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        $product->update(['name' => $validated['name']]);

        // Update or create variants
        foreach ($validated['variants'] as $variantData) {
            if (isset($variantData['id'])) {
                // Update existing variant
                 $variant = Variant::where('id', $variantData['id'])
                            ->where('product_id', $productId)
                            ->firstOrFail();

                $variant->update([
                    'name' => $variantData['variantname'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                ]);
            }
            else {
                // Create new variant
                $product->variants()->create([
                    'name' => $variantData['variantname'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                ]);
            }
        }

        // Sync categories
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        return view('manage')->with('success', 'Product updated successfully');

    }

}
