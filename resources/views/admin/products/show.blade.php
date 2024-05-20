@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
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
                    <h3 class="card-title">Product Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $product->product_id }}</dd>
                        <dt class="col-sm-4">Organization</dt>
                        <dd class="col-sm-8">{{ $product->organization_id }}</dd>
                        <dt class="col-sm-4">Warehouse</dt>
                        <dd class="col-sm-8">{{ $product->warehouse_id }}</dd>
                        <dt class="col-sm-4">Name</dt>
                        <dd class="col-sm-8">{{ $product->name }}</dd>
                        <dt class="col-sm-4">SKU</dt>
                        @if ($product->sku)
                            <dd class="col-sm-8"><img src="data:image/svg+xml;base64,{{ $product->sku }}" alt="QR Code" width="50"></dd>
                        @endif
                        <dt class="col-sm-4">Stock Quantity</dt>
                        <dd class="col-sm-8">{{ $product->stock_quantity }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
