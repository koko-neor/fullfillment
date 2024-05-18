@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('order-details.index') }}">Order Details</a></li>
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
                    <h3 class="card-title">Order Detail Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $orderDetail->detail_id }}</dd>
                        <dt class="col-sm-4">Order</dt>
                        <dd class="col-sm-8">{{ $orderDetail->order->id }}</dd>
                        <dt class="col-sm-4">Product</dt>
                        <dd class="col-sm-8">{{ $orderDetail->product->name }}</dd>
                        <dt class="col-sm-4">Quantity Ordered</dt>
                        <dd class="col-sm-8">{{ $orderDetail->quantity_ordered }}</dd>
                        <dt class="col-sm-4">Label</dt>
                        <dd class="col-sm-8">{{ $orderDetail->label->barcode }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('order-details.edit', $orderDetail->detail_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('order-details.destroy', $orderDetail->detail_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('order-details.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
