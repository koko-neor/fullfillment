<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Organization;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return View
     */
    public function index(): View
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return View
     */
    public function create(): View
    {
        $organizations = Organization::all();
        $warehouses = Warehouse::all();
        return view('admin.orders.form', compact('organizations', 'warehouses'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,organization_id',
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'type' => 'nullable|string',
            'marketplace' => 'nullable|string',
            'status' => 'nullable|string',
            'seller_comments' => 'nullable|string',
            'warehouse_comments' => 'nullable|string',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified order.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param Order $order
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Order $order): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $organizations = Organization::all();
        $warehouses = Warehouse::all();
        return view('admin.orders.form', compact('order', 'organizations', 'warehouses'));
    }

    /**
     * Update the specified order in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,organization_id',
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'type' => 'nullable|string',
            'marketplace' => 'nullable|string',
            'status' => 'nullable|string',
            'seller_comments' => 'nullable|string',
            'warehouse_comments' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
