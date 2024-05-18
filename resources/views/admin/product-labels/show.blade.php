@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Label Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('product-labels.index') }}">Product Labels</a></li>
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
                    <h3 class="card-title">Product Label Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $productLabel->label_id }}</dd>
                        <dt class="col-sm-4">Product</dt>
                        <dd class="col-sm-8">{{ $productLabel->product_id }}</dd>
                        <dt class="col-sm-4">Barcode</dt>
                        <dd class="col-sm-8">{{ $productLabel->barcode }}</dd>
                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ $productLabel->type }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product-labels.edit', $productLabel->label_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('product-labels.destroy', $productLabel->label_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('product-labels.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
