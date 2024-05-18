<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductLabel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class OrderDetailController
 * @package App\Http\Controllers
 */
class OrderDetailController extends Controller
{
    /**
     * Display a listing of the order details.
     *
     * @return View
     */
    public function index(): View
    {
        $orderDetails = OrderDetail::all();
        return view('admin.order-details.index', compact('orderDetails'));
    }

    /**
     * Show the form for creating a new order detail.
     *
     * @return View
     */
    public function create(): View
    {
        $orders = Order::all();
        $products = Product::all();
        $labels = ProductLabel::all();
        return view('admin.order-details.form', compact('orders', 'products', 'labels'));
    }

    /**
     * Store a newly created order detail in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity_ordered' => 'nullable|integer',
            'label_id' => 'required|exists:product_labels,label_id',
        ]);

        OrderDetail::create($validated);

        return redirect()->route('order-details.index');
    }

    /**
     * Display the specified order detail.
     *
     * @param OrderDetail $orderDetail
     * @return View
     */
    public function show(OrderDetail $orderDetail): View
    {
        return view('admin.order-details.show', compact('orderDetail'));
    }

    /**
     * Show the form for editing the specified order detail.
     *
     * @param OrderDetail $orderDetail
     * @return View
     */
    public function edit(OrderDetail $orderDetail): View
    {
        $orders = Order::all();
        $products = Product::all();
        $labels = ProductLabel::all();
        return view('admin.order-details.form', compact('orderDetail', 'orders', 'products', 'labels'));
    }

    /**
     * Update the specified order detail in storage.
     *
     * @param Request $request
     * @param OrderDetail $orderDetail
     * @return RedirectResponse
     */
    public function update(Request $request, OrderDetail $orderDetail): RedirectResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity_ordered' => 'nullable|integer',
            'label_id' => 'required|exists:product_labels,label_id',
        ]);

        $orderDetail->update($validated);

        return redirect()->route('order-details.index');
    }

    /**
     * Remove the specified order detail from storage.
     *
     * @param OrderDetail $orderDetail
     * @return RedirectResponse
     */
    public function destroy(OrderDetail $orderDetail): RedirectResponse
    {
        $orderDetail->delete();

        return redirect()->route('order-details.index');
    }
}
