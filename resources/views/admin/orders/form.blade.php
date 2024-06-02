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
                    <form action="{{ isset($order) ? route('orders.update', $order->order_id) : route('orders.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ isset($order) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
