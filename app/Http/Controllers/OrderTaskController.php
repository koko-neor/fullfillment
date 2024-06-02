<?php

namespace App\Http\Controllers;

use App\Models\OrderTask;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class OrderTaskController
 * @package App\Http\Controllers
 */
class OrderTaskController extends Controller
{
    /**
     * Display a listing of the order tasks.
     *
     * @return View
     */
    public function index(): View
    {
        $orderTasks = OrderTask::all();
        return view('admin.order-tasks.index', compact('orderTasks'));
    }

    /**
     * Show the form for creating a new order task.
     *
     * @return View
     */
    public function create(): View
    {
        $orders = Order::all();
        $users = User::all();
        return view('admin.order-tasks.form', compact('orders', 'users'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'assigned_to' => 'required|exists:users,user_id',
            'task_type' => 'required|string',
            'status' => 'required|string',
            'comments' => 'nullable|string',
        ]);

        $orderTask = OrderTask::create($validated);

        return response()->json(['success' => true, 'task' => $orderTask]);
    }

    /**
     * Display the specified order task.
     *
     * @param OrderTask $orderTask
     * @return View
     */
    public function show(OrderTask $orderTask): View
    {
        return view('admin.order-tasks.show', compact('orderTask'));
    }

    /**
     * Show the form for editing the specified order task.
     *
     * @param OrderTask $orderTask
     * @return View
     */
    public function edit(OrderTask $orderTask): View
    {
        $orders = Order::all();
        $users = User::all();
        return view('admin.order-tasks.form', compact('orderTask', 'orders', 'users'));
    }

    /**
     * Update the specified order task in storage.
     *
     * @param Request $request
     * @param OrderTask $orderTask
     * @return RedirectResponse
     */
    public function update(Request $request, OrderTask $orderTask): RedirectResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'assigned_to' => 'required|exists:users,user_id',
            'task_type' => 'nullable|string',
            'status' => 'nullable|string',
            'comments' => 'nullable|string',
            'created_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
        ]);

        $orderTask->update($validated);

        return redirect()->route('order-tasks.index');
    }

    /**
     * Remove the specified order task from storage.
     *
     * @param OrderTask $orderTask
     * @return RedirectResponse
     */
    public function destroy(OrderTask $orderTask): RedirectResponse
    {
        $orderTask->delete();

        return redirect()->route('order-tasks.index');
    }
}
