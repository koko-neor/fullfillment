@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($productLabel) ? 'Edit' : 'Create' }} Product Label</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($productLabel) ? route('product-labels.update', $productLabel->label_id) : route('product-labels.store') }}" method="POST">
                        @csrf
                        @if(isset($productLabel))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product</label>
                            <select class="form-control" id="product_id" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ (isset($productLabel) && $productLabel->product_id == $product->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode', $productLabel->barcode ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $productLabel->type ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($productLabel) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
