@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($productStorage) ? 'Edit' : 'Create' }} Product Storage</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($productStorage) ? route('product-storages.update', $productStorage->storage_id) : route('product-storages.store') }}" method="POST">
                        @csrf
                        @if(isset($productStorage))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product</label>
                            <select class="form-control" id="product_id" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ (isset($productStorage) && $productStorage->product_id == $product->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="block_id" class="form-label">Block</label>
                            <select class="form-control" id="block_id" name="block_id">
                                @foreach($blocks as $block)
                                    <option value="{{ $block->block_id }}" {{ (isset($productStorage) && $productStorage->block_id == $block->block_id) ? 'selected' : '' }}>{{ $block->location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $productStorage->status ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($productStorage) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
