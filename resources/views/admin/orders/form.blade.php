@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($order) ? 'Edit' : 'Create' }} Order</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($order) ? route('orders.update', $order->order_id) : route('orders.store') }}" method="POST">
                        @csrf
                        @if(isset($order))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="organization_id" class="form-label">Organization</label>
                            <select class="form-control" id="organization_id" name="organization_id">
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->organization_id }}" {{ (isset($order) && $order->organization_id == $organization->organization_id) ? 'selected' : '' }}>{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Warehouse</label>
                            <select class="form-control" id="warehouse_id" name="warehouse_id">
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->warehouse_id }}" {{ (isset($order) && $order->warehouse_id == $warehouse->warehouse_id) ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $order->type ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="marketplace" class="form-label">Marketplace</label>
                            <input type="text" class="form-control" id="marketplace" name="marketplace" value="{{ old('marketplace', $order->marketplace ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $order->status ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="seller_comments" class="form-label">Seller Comments</label>
                            <textarea class="form-control" id="seller_comments" name="seller_comments">{{ old('seller_comments', $order->seller_comments ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="warehouse_comments" class="form-label">Warehouse Comments</label>
                            <textarea class="form-control" id="warehouse_comments" name="warehouse_comments">{{ old('warehouse_comments', $order->warehouse_comments ?? '') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($order) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
