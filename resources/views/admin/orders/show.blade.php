@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
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
                    <h3 class="card-title">Order Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $order->order_id }}</dd>
                        <dt class="col-sm-4">Organization</dt>
                        <dd class="col-sm-8">{{ $order->organization->name }}</dd>
                        <dt class="col-sm-4">Warehouse</dt>
                        <dd class="col-sm-8">{{ $order->warehouse->name }}</dd>
                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ $order->type }}</dd>
                        <dt class="col-sm-4">Marketplace</dt>
                        <dd class="col-sm-8">{{ $order->marketplace }}</dd>
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ $order->status }}</dd>
                        <dt class="col-sm-4">Seller Comments</dt>
                        <dd class="col-sm-8">{{ $order->seller_comments }}</dd>
                        <dt class="col-sm-4">Warehouse Comments</dt>
                        <dd class="col-sm-8">{{ $order->warehouse_comments }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
