<?php

namespace App\Http\Controllers;

use App\Models\ReturnOrder;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ReturnOrderController
 * @package App\Http\Controllers
 */
class ReturnOrderController extends Controller
{
    /**
     * Display a listing of the returns.
     *
     * @return View
     */
    public function index(): View
    {
        $returnOrders = ReturnOrder::all();
        return view('admin.return-orders.index', compact('returnOrders'));
    }

    /**
     * Show the form for creating a new return order.
     *
     * @return View
     */
    public function create(): View
    {
        $orderDetails = OrderDetail::all();
        return view('admin.return-orders.form', compact('orderDetails'));
    }

    /**
     * Store a newly created return order in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_detail_id' => 'required|exists:order_details,detail_id',
            'reason' => 'nullable|string',
            'date_returned' => 'nullable|date',
        ]);

        ReturnOrder::create($validated);

        return redirect()->route('return-orders.index');
    }

    /**
     * Display the specified return order.
     *
     * @param ReturnOrder $returnOrder
     * @return View
     */
    public function show(ReturnOrder $returnOrder): View
    {
        return view('admin.return-orders.show', compact('returnOrder'));
    }

    /**
     * Show the form for editing the specified return order.
     *
     * @param ReturnOrder $returnOrder
     * @return View
     */
    public function edit(ReturnOrder $returnOrder): View
    {
        $orderDetails = OrderDetail::all();
        return view('admin.return-orders.form', compact('returnOrder', 'orderDetails'));
    }

    /**
     * Update the specified return order in storage.
     *
     * @param Request $request
     * @param ReturnOrder $returnOrder
     * @return RedirectResponse
     */
    public function update(Request $request, ReturnOrder $returnOrder): RedirectResponse
    {
        $validated = $request->validate([
            'order_detail_id' => 'required|exists:order_details,detail_id',
            'reason' => 'nullable|string',
            'date_returned' => 'nullable|date',
        ]);

        $returnOrder->update($validated);

        return redirect()->route('return-orders.index');
    }

    /**
     * Remove the specified return order from storage.
     *
     * @param ReturnOrder $returnOrder
     * @return RedirectResponse
     */
    public function destroy(ReturnOrder $returnOrder): RedirectResponse
    {
        $returnOrder->delete();

        return redirect()->route('return-orders.index');
    }
}
