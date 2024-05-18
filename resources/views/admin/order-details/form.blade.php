@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($orderDetail) ? 'Edit' : 'Create' }} Order Detail</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($orderDetail) ? route('order-details.update', $orderDetail->detail_id) : route('order-details.store') }}" method="POST">
                        @csrf
                        @if(isset($orderDetail))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Order</label>
                            <select class="form-control" id="order_id" name="order_id">
                                @foreach($orders as $order)
                                    <option value="{{ $order->order_id }}" {{ (isset($orderDetail) && $orderDetail->order_id == $order->order_id) ? 'selected' : '' }}>{{ $order->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product</label>
                            <select class="form-control" id="product_id" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ (isset($orderDetail) && $orderDetail->product_id == $product->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_ordered" class="form-label">Quantity Ordered</label>
                            <input type="number" class="form-control" id="quantity_ordered" name="quantity_ordered" value="{{ old('quantity_ordered', $orderDetail->quantity_ordered ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="label_id" class="form-label">Label</label>
                            <select class="form-control" id="label_id" name="label_id">
                                @foreach($labels as $label)
                                    <option value="{{ $label->label_id }}" {{ (isset($orderDetail) && $orderDetail->label_id == $label->label_id) ? 'selected' : '' }}>{{ $label->barcode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($orderDetail) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
