@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($orderTask) ? 'Edit' : 'Create' }} Order Task</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($orderTask) ? route('order-tasks.update', $orderTask->task_id) : route('order-tasks.store') }}" method="POST">
                        @csrf
                        @if(isset($orderTask))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Order</label>
                            <select class="form-control" id="order_id" name="order_id">
                                @foreach($orders as $order)
                                    <option value="{{ $order->order_id }}" {{ (isset($orderTask) && $orderTask->order_id == $order->order_id) ? 'selected' : '' }}>{{ $order->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assigned_to" class="form-label">Assigned To</label>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}" {{ (isset($orderTask) && $orderTask->assigned_to == $user->user_id) ? 'selected' : '' }}>{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="task_type" class="form-label">Task Type</label>
                            <input type="text" class="form-control" id="task_type" name="task_type" value="{{ old('task_type', $orderTask->task_type ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $orderTask->status ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" name="comments">{{ old('comments', $orderTask->comments ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="created_at" class="form-label">Created At</label>
                            <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="{{ old('created_at', isset($orderTask->created_at) ? $orderTask->created_at->format('Y-m-d\TH:i') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="completed_at" class="form-label">Completed At</label>
                            <input type="datetime-local" class="form-control" id="completed_at" name="completed_at" value="{{ old('completed_at', isset($orderTask->completed_at) ? $orderTask->completed_at->format('Y-m-d\TH:i') : '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($orderTask) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
