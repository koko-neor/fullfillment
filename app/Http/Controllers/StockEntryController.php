<?php

namespace App\Http\Controllers;

use App\Models\StockEntry;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class StockEntryController
 * @package App\Http\Controllers
 */
class StockEntryController extends Controller
{
    /**
     * Display a listing of the stock entries.
     *
     * @return View
     */
    public function index(): View
    {
        $stockEntries = StockEntry::all();
        return view('admin.stock-entries.index', compact('stockEntries'));
    }

    /**
     * Show the form for creating a new stock entry.
     *
     * @return View
     */
    public function create(): View
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
        return view('admin.stock-entries.form', compact('products', 'warehouses'));
    }

    /**
     * Store a newly created stock entry in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'quantity_received' => 'nullable|integer',
            'date_received' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        StockEntry::create($validated);

        return redirect()->route('stock-entries.index');
    }

    /**
     * Display the specified stock entry.
     *
     * @param StockEntry $stockEntry
     * @return View
     */
    public function show(StockEntry $stockEntry): View
    {
        return view('admin.stock-entries.show', compact('stockEntry'));
    }

    /**
     * Show the form for editing the specified stock entry.
     *
     * @param StockEntry $stockEntry
     * @return View
     */
    public function edit(StockEntry $stockEntry): View
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
        return view('admin.stock-entries.form', compact('stockEntry', 'products', 'warehouses'));
    }

    /**
     * Update the specified stock entry in storage.
     *
     * @param Request $request
     * @param StockEntry $stockEntry
     * @return RedirectResponse
     */
    public function update(Request $request, StockEntry $stockEntry): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'quantity_received' => 'nullable|integer',
            'date_received' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        $stockEntry->update($validated);

        return redirect()->route('stock-entries.index');
    }

    /**
     * Remove the specified stock entry from storage.
     *
     * @param StockEntry $stockEntry
     * @return RedirectResponse
     */
    public function destroy(StockEntry $stockEntry): RedirectResponse
    {
        $stockEntry->delete();

        return redirect()->route('stock-entries.index');
    }
}
