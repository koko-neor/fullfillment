<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Organization;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create(): View
    {
        $organizations = Organization::all();
        $warehouses = Warehouse::all();
        return view('admin.products.form', compact('organizations', 'warehouses'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,organization_id',
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'name' => 'nullable|string',
            'sku' => 'nullable|string',
            'stock_quantity' => 'nullable|integer',
        ]);

        Product::create($validated);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified product.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $organizations = Organization::all();
        $warehouses = Warehouse::all();
        return view('admin.products.form', compact('product', 'organizations', 'warehouses'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,organization_id',
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'name' => 'nullable|string',
            'sku' => 'nullable|string',
            'stock_quantity' => 'nullable|integer',
        ]);

        $product->update($validated);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
