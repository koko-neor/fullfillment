@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Storage Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('product-storages.index') }}">Product Storages</a></li>
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
                    <h3 class="card-title">Product Storage Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $productStorage->storage_id }}</dd>
                        <dt class="col-sm-4">Product</dt>
                        <dd class="col-sm-8">{{ $productStorage->product_id }}</dd>
                        <dt class="col-sm-4">Block</dt>
                        <dd class="col-sm-8">{{ $productStorage->block_id }}</dd>
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ $productStorage->status }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product-storages.edit', $productStorage->storage_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('product-storages.destroy', $productStorage->storage_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('product-storages.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
