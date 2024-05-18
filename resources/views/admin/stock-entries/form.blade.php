@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($stockEntry) ? 'Edit' : 'Create' }} Stock Entry</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($stockEntry) ? route('stock-entries.update', $stockEntry->entry_id) : route('stock-entries.store') }}" method="POST">
                        @csrf
                        @if(isset($stockEntry))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product</label>
                            <select class="form-control" id="product_id" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ (isset($stockEntry) && $stockEntry->product_id == $product->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Warehouse</label>
                            <select class="form-control" id="warehouse_id" name="warehouse_id">
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->warehouse_id }}" {{ (isset($stockEntry) && $stockEntry->warehouse_id == $warehouse->warehouse_id) ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_received" class="form-label">Quantity Received</label>
                            <input type="number" class="form-control" id="quantity_received" name="quantity_received" value="{{ old('quantity_received', $stockEntry->quantity_received ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="date_received" class="form-label">Date Received</label>
                            <input type="datetime-local" class="form-control" id="date_received" name="date_received" value="{{ old('date_received', isset($stockEntry->date_received) ? $stockEntry->date_received->format('Y-m-d\TH:i') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" name="comments">{{ old('comments', $stockEntry->comments ?? '') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($stockEntry) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
