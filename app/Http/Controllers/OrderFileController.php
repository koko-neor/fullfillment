<?php

namespace App\Http\Controllers;

use App\Models\OrderFile;
use App\Models\OrderTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class OrderFileController
 * @package App\Http\Controllers
 */
class OrderFileController extends Controller
{
    /**
     * Display a listing of the order files.
     *
     * @return View
     */
    public function index(): View
    {
        $orderFiles = OrderFile::all();
        return view('admin.order-files.index', compact('orderFiles'));
    }

    /**
     * Show the form for creating a new order file.
     *
     * @return View
     */
    public function create(): View
    {
        $tasks = OrderTask::all();
        $users = User::all();
        return view('admin.order-files.form', compact('tasks', 'users'));
    }

    /**
     * Store a newly created order file in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:order_tasks,task_id',
            'uploaded_by' => 'required|exists:users,user_id',
            'file_path' => 'nullable|string',
            'file_type' => 'nullable|string',
            'uploaded_at' => 'nullable|date',
        ]);

        OrderFile::create($validated);

        return redirect()->route('order-files.index');
    }

    /**
     * Display the specified order file.
     *
     * @param OrderFile $orderFile
     * @return View
     */
    public function show(OrderFile $orderFile): View
    {
        return view('admin.order-files.show', compact('orderFile'));
    }

    /**
     * Show the form for editing the specified order file.
     *
     * @param OrderFile $orderFile
     * @return View
     */
    public function edit(OrderFile $orderFile): View
    {
        $tasks = OrderTask::all();
        $users = User::all();
        return view('admin.order-files.form', compact('orderFile', 'tasks', 'users'));
    }

    /**
     * Update the specified order file in storage.
     *
     * @param Request $request
     * @param OrderFile $orderFile
     * @return RedirectResponse
     */
    public function update(Request $request, OrderFile $orderFile): RedirectResponse
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:order_tasks,task_id',
            'uploaded_by' => 'required|exists:users,user_id',
            'file_path' => 'nullable|string',
            'file_type' => 'nullable|string',
            'uploaded_at' => 'nullable|date',
        ]);

        $orderFile->update($validated);

        return redirect()->route('order-files.index');
    }

    /**
     * Remove the specified order file from storage.
     *
     * @param OrderFile $orderFile
     * @return RedirectResponse
     */
    public function destroy(OrderFile $orderFile): RedirectResponse
    {
        $orderFile->delete();

        return redirect()->route('order-files.index');
    }
}
