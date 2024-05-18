<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class WarehouseController
 * @package App\Http\Controllers
 */
class WarehouseController extends Controller
{
    /**
     * Display a listing of the warehouses.
     *
     * @return View
     */
    public function index(): View
    {
        $warehouses = Warehouse::all();
        return view('admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new warehouse.
     *
     * @return View
     */
    public function create(): View
    {
        $organizations = Organization::all();
        return view('admin.warehouses.form', compact('organizations'));
    }

    /**
     * Store a newly created warehouse in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,organization_id',
            'name' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Warehouse::create($validated);

        return redirect()->route('warehouses.index');
    }

    /**
     * Display the specified warehouse.
     *
     * @param Warehouse $warehouse
     * @return View
     */
    public function show(Warehouse $warehouse): View
    {
        return view('admin.warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified warehouse.
     *
     * @param Warehouse $warehouse
     * @return View
     */
    public function edit(Warehouse $warehouse): View
    {
        $organizations = Organization::all();
        return view('admin.warehouses.form', compact('warehouse', 'organizations'));
    }

    /**
     * Update the specified warehouse in storage.
     *
     * @param Request $request
     * @param Warehouse $warehouse
     * @return RedirectResponse
     */
    public function update(Request $request, Warehouse $warehouse): RedirectResponse
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,organization_id',
            'name' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $warehouse->update($validated);

        return redirect()->route('warehouses.index');
    }

    /**
     * Remove the specified warehouse from storage.
     *
     * @param Warehouse $warehouse
     * @return RedirectResponse
     */
    public function destroy(Warehouse $warehouse): RedirectResponse
    {
        $warehouse->delete();

        return redirect()->route('warehouses.index');
    }
}
