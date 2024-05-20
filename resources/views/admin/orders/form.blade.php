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
                            <label for="warehouse_id" class="form-label">Warehouse</label>
                            <select class="form-control" id="warehouse_id" name="warehouse_id">
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->warehouse_id }}" {{ isset($order) && $order->warehouse_id == $warehouse->warehouse_id ? 'selected' : '' }}>
                                        {{ $warehouse->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="приемка" {{ isset($order) && $order->type == 'приемка' ? 'selected' : '' }}>приемка</option>
                                <option value="выдача" {{ isset($order) && $order->type == 'выдача' ? 'selected' : '' }}>выдача</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="marketplace" class="form-label">Marketplace</label>
                            <input type="text" class="form-control" id="marketplace" name="marketplace" value="{{ old('marketplace', $order->marketplace ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control" id="comment" name="comment">{{ old('comment', '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Products</label>
                            <table class="table table-bordered" id="products-table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity Ordered</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($order) && $order->orderDetails->count() > 0)
                                    @foreach($order->orderDetails as $key => $orderDetail)
                                        <tr>
                                            <td>
                                                <select name="products[{{ $key }}][product_id]" class="form-control">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->product_id }}" {{ $product->product_id == $orderDetail->product_id ? 'selected' : '' }}>
                                                            {{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="products[{{ $key }}][quantity_ordered]" class="form-control" value="{{ $orderDetail->quantity_ordered }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger remove-product">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr id="no-product-row">
                                        <td colspan="3" class="text-center">No products added yet</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="add-product">Добавить продукт</button>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-success" id="create-product">Создать продукт</button>
                        </div>

                        <div id="new-product-fields" class="mb-3" style="display: none;">
                            <label for="new_product[name]" class="form-label">New Product Name</label>
                            <input type="text" name="new_product[name]" class="form-control mt-2" placeholder="Product Name">
                            <input type="number" name="new_product[stock_quantity]" class="form-control mt-2" placeholder="Stock Quantity">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ isset($order) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let productIndex = {{ isset($order) ? $order->orderDetails->count() : 0 }};
            document.getElementById('add-product').addEventListener('click', function () {
                let tableBody = document.querySelector('#products-table tbody');
                let newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>
                        <select name="products[${productIndex}][product_id]" class="form-control">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                            @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="products[${productIndex}][quantity_ordered]" class="form-control" placeholder="Quantity Ordered">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-product">Remove</button>
                    </td>
                `;
                tableBody.appendChild(newRow);
                document.getElementById('no-product-row')?.remove();
                productIndex++;
            });

            document.getElementById('create-product').addEventListener('click', function () {
                document.getElementById('new-product-fields').style.display = 'block';
            });

            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-product')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection
