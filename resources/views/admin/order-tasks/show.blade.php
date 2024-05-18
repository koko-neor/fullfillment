@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('order-tasks.index') }}">Order Tasks</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Task Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $orderTask->task_id }}</dd>
                        <dt class="col-sm-4">Order</dt>
                        <dd class="col-sm-8">{{ $orderTask->order_id }}</dd>
                        <dt class="col-sm-4">Assigned To</dt>
                        <dd class="col-sm-8">{{ $orderTask->assigned_to }}</dd>
                        <dt class="col-sm-4">Task Type</dt>
                        <dd class="col-sm-8">{{ $orderTask->task_type }}</dd>
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ $orderTask->status }}</dd>
                        <dt class="col-sm-4">Comments</dt>
                        <dd class="col-sm-8">{{ $orderTask->comments }}</dd>
                        <dt class="col-sm-4">Created At</dt>
                        <dd class="col-sm-8">{{ $orderTask->created_at }}</dd>
                        <dt class="col-sm-4">Completed At</dt>
                        <dd class="col-sm-8">{{ $orderTask->completed_at }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('order-tasks.edit', $orderTask->task_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('order-tasks.destroy', $orderTask->task_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('order-tasks.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
