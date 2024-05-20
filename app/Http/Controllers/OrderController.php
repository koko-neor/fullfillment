<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.orders.form', compact('warehouses', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'warehouse_id' => 'required|exists:warehouses,warehouse_id',
            'type' => 'required|string|in:приемка,выдача',
            'marketplace' => 'nullable|string',
            'comment' => 'nullable|string',
            'products' => 'sometimes|array',
            'products.*.product_id' => 'nullable|exists:products,product_id',
            'products.*.quantity_ordered' => 'required_with:products|integer',
            'new_product.name' => 'nullable|string',
            'new_product.stock_quantity' => 'nullable|integer',
        ]);

        $validated['organization_id'] = Auth::user()->organization_id;
        $validated['status'] = 'ожидание';

        $comment = $validated['comment'] ?? null;
        unset($validated['comment']);

        $order = new Order($validated);

        if ($validated['type'] == 'приемка') {
            $order->seller_comments = $comment;
        } else if ($validated['type'] == 'выдача') {
            $order->warehouse_comments = $comment;
        }

        $order->save();

        // Обработка существующих продуктов
        if (!empty($validated['products'])) {
            foreach ($validated['products'] as $productData) {
                $product = Product::find($productData['product_id']);

                $product->decrement('stock_quantity', $productData['quantity_ordered']);

                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $product->product_id,
                    'quantity_ordered' => $productData['quantity_ordered'],
                ]);
            }
        }

        // Обработка нового продукта
        if (!empty($validated['new_product']['name'])) {
            $newProduct = Product::create([
                'organization_id' => $order->organization_id,
                'warehouse_id' => $order->warehouse_id,
                'name' => $validated['new_product']['name'],
                'stock_quantity' => $validated['new_product']['stock_quantity'],
            ]);

            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_id' => $newProduct->product_id,
                'quantity_ordered' => $validated['new_product']['stock_quantity'],
            ]);

            $newProduct->decrement('stock_quantity', $validated['new_product']['stock_quantity']);
        }

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
