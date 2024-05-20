@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($product) ? 'Edit' : 'Create' }} Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($product) ? route('products.update', $product->product_id) : route('products.store') }}" method="POST">
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="organization_id" class="form-label">Organization</label>
                            <select class="form-control" id="organization_id" name="organization_id">
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->organization_id }}" {{ (isset($product) && $product->organization_id == $organization->organization_id) ? 'selected' : '' }}>{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Warehouse</label>
                            <select class="form-control" id="warehouse_id" name="warehouse_id">
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->warehouse_id }}" {{ (isset($product) && $product->warehouse_id == $warehouse->warehouse_id) ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
