<?php

namespace App\Http\Controllers;

use App\Models\StorageBlock;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class StorageBlockController
 * @package App\Http\Controllers
 */
class StorageBlockController extends Controller
{
    /**
     * Display a listing of the storage blocks.
     *
     * @return View
     */
    public function index(): View
    {
        $storageBlocks = StorageBlock::all();
        return view('admin.storage-blocks.index', compact('storageBlocks'));
    }

    /**
     * Show the form for creating a new storage block.
     *
     * @return View
     */
    public function create(): View
    {
        $warehouses = Warehouse::all();
        return view('admin.storage-blocks.form', compact('warehouses'));
    }

    /**
     * Store a newly created storage block in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'type' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        StorageBlock::create($validated);

        return redirect()->route('storage-blocks.index');
    }

    /**
     * Display the specified storage block.
     *
     * @param StorageBlock $storageBlock
     * @return View
     */
    public function show(StorageBlock $storageBlock): View
    {
        return view('admin.storage-blocks.show', compact('storageBlock'));
    }

    /**
     * Show the form for editing the specified storage block.
     *
     * @param StorageBlock $storageBlock
     * @return View
     */
    public function edit(StorageBlock $storageBlock): View
    {
        $warehouses = Warehouse::all();
        return view('admin.storage-blocks.form', compact('storageBlock', 'warehouses'));
    }

    /**
     * Update the specified storage block in storage.
     *
     * @param Request $request
     * @param StorageBlock $storageBlock
     * @return RedirectResponse
     */
    public function update(Request $request, StorageBlock $storageBlock): RedirectResponse
    {
        $validated = $request->validate([
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'type' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $storageBlock->update($validated);

        return redirect()->route('storage-blocks.index');
    }

    /**
     * Remove the specified storage block from storage.
     *
     * @param StorageBlock $storageBlock
     * @return RedirectResponse
     */
    public function destroy(StorageBlock $storageBlock): RedirectResponse
    {
        $storageBlock->delete();

        return redirect()->route('storage-blocks.index');
    }
}
