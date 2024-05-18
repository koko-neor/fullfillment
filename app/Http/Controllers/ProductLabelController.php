<?php

namespace App\Http\Controllers;

use App\Models\ProductLabel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ProductLabelController
 * @package App\Http\Controllers
 */
class ProductLabelController extends Controller
{
    /**
     * Display a listing of the product labels.
     *
     * @return View
     */
    public function index(): View
    {
        $productLabels = ProductLabel::all();
        return view('admin.product-labels.index', compact('productLabels'));
    }

    /**
     * Show the form for creating a new product label.
     *
     * @return View
     */
    public function create(): View
    {
        $products = Product::all();
        return view('admin.product-labels.form', compact('products'));
    }

    /**
     * Store a newly created product label in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'barcode' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        ProductLabel::create($validated);

        return redirect()->route('product-labels.index');
    }

    /**
     * Display the specified product label.
     *
     * @param ProductLabel $productLabel
     * @return View
     */
    public function show(ProductLabel $productLabel): View
    {
        return view('admin.product-labels.show', compact('productLabel'));
    }

    /**
     * Show the form for editing the specified product label.
     *
     * @param ProductLabel $productLabel
     * @return View
     */
    public function edit(ProductLabel $productLabel): View
    {
        $products = Product::all();
        return view('admin.product-labels.form', compact('productLabel', 'products'));
    }

    /**
     * Update the specified product label in storage.
     *
     * @param Request $request
     * @param ProductLabel $productLabel
     * @return RedirectResponse
     */
    public function update(Request $request, ProductLabel $productLabel): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'barcode' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        $productLabel->update($validated);

        return redirect()->route('product-labels.index');
    }

    /**
     * Remove the specified product label from storage.
     *
     * @param ProductLabel $productLabel
     * @return RedirectResponse
     */
    public function destroy(ProductLabel $productLabel): RedirectResponse
    {
        $productLabel->delete();

        return redirect()->route('product-labels.index');
    }
}
