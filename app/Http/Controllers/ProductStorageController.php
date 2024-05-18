<?php

namespace App\Http\Controllers;

use App\Models\ProductStorage;
use App\Models\Product;
use App\Models\StorageBlock;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ProductStorageController
 * @package App\Http\Controllers
 */
class ProductStorageController extends Controller
{
    /**
     * Display a listing of the product storage.
     *
     * @return View
     */
    public function index(): View
    {
        $productStorages = ProductStorage::all();
        return view('admin.product-storages.index', compact('productStorages'));
    }

    /**
     * Show the form for creating a new product storage.
     *
     * @return View
     */
    public function create(): View
    {
        $products = Product::all();
        $blocks = StorageBlock::all();
        return view('admin.product-storages.form', compact('products', 'blocks'));
    }

    /**
     * Store a newly created product storage in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'block_id' => 'required|exists:storage_blocks,block_id',
            'status' => 'nullable|string',
        ]);

        ProductStorage::create($validated);

        return redirect()->route('product-storages.index');
    }

    /**
     * Display the specified product storage.
     *
     * @param ProductStorage $productStorage
     * @return View
     */
    public function show(ProductStorage $productStorage): View
    {
        return view('admin.product-storages.show', compact('productStorage'));
    }

    /**
     * Show the form for editing the specified product storage.
     *
     * @param ProductStorage $productStorage
     * @return View
     */
    public function edit(ProductStorage $productStorage): View
    {
        $products = Product::all();
        $blocks = StorageBlock::all();
        return view('admin.product-storages.form', compact('productStorage', 'products', 'blocks'));
    }

    /**
     * Update the specified product storage in storage.
     *
     * @param Request $request
     * @param ProductStorage $productStorage
     * @return RedirectResponse
     */
    public function update(Request $request, ProductStorage $productStorage): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'block_id' => 'required|exists:storage_blocks,block_id',
            'status' => 'nullable|string',
        ]);

        $productStorage->update($validated);

        return redirect()->route('product-storages.index');
    }

    /**
     * Remove the specified product storage from storage.
     *
     * @param ProductStorage $productStorage
     * @return RedirectResponse
     */
    public function destroy(ProductStorage $productStorage): RedirectResponse
    {
        $productStorage->delete();

        return redirect()->route('product-storages.index');
    }
}
