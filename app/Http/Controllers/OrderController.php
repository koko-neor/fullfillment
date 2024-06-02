<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderFile;
use App\Models\OrderTask;
use App\Models\Organization;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
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

        // Сохранение файла
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            OrderFile::create([
                'task_id' => null,
                'uploaded_by' => Auth::id(),
                'file_path' => $filePath,
                'file_type' => $request->file('file')->getClientOriginalExtension(),
                'uploaded_at' => now(),
            ]);
        }

        // Добавление задачи
        OrderTask::create([
            'order_id' => $order->order_id,
            'assigned_to' => Auth::id(),
            'task_type' => 'Order Creation',
            'status' => 'Pending',
            'comments' => $comment,
            'created_at' => now(),
        ]);

        return redirect()->route('orders.show', $order->order_id);
    }

    /**
     * Display the specified order.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        $orderDetails = $order->orderDetails()->with('product')->get();
        $products = Product::all();
        $tasks = $order->tasks()->get();
        $users = User::all();

        return view('admin.orders.show', compact('order', 'orderDetails', 'products', 'tasks', 'users'));
    }

    /**
     * Создать новый продукт через AJAX.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeProductAjax(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'stock_quantity' => 'required|integer',
            'article' => 'nullable|string',
            'brand' => 'nullable|string',
            'color' => 'nullable|string',
            'weight' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $validated['organization_id'] = Auth::user()->organization_id ?? null;
        $warehouse = Warehouse::where('organization_id', $validated['organization_id'])->firstOrFail();
        $validated['warehouse_id'] = $warehouse->warehouse_id ?? null;

        $product = Product::create($validated);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function removeProductFromOrderAjax(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'detail_id' => 'required|exists:order_details,detail_id',
        ]);

        $orderDetail = OrderDetail::find($validated['detail_id']);
        $product = Product::find($orderDetail->product_id);
        $product->increment('stock_quantity', $orderDetail->quantity_ordered);

        $orderDetail->delete();

        return response()->json(['success' => true]);
    }

    public function searchProductsAjax(Request $request): JsonResponse
    {
        $search = $request->input('text');
        $products = Product::where('name', 'LIKE', "%{$search}%")->get(['product_id', 'name as text']);

        return response()->json($products);
    }

    /**
     * Добавить продукт к заказу через AJAX.
     *
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function addProductToOrderAjax(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity_ordered' => 'required|integer',
        ]);

        $product = Product::find($validated['product_id']);
        $product->decrement('stock_quantity', $validated['quantity_ordered']);

        OrderDetail::create([
            'order_id' => $order->order_id,
            'product_id' => $product->product_id,
            'quantity_ordered' => $validated['quantity_ordered'],
        ]);

        return response()->json(['success' => true]);
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
