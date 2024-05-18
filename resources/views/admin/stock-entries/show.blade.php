@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Entry Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('stock-entries.index') }}">Stock Entries</a></li>
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
                    <h3 class="card-title">Stock Entry Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $stockEntry->entry_id }}</dd>
                        <dt class="col-sm-4">Product</dt>
                        <dd class="col-sm-8">{{ $stockEntry->product_id }}</dd>
                        <dt class="col-sm-4">Warehouse</dt>
                        <dd class="col-sm-8">{{ $stockEntry->warehouse_id }}</dd>
                        <dt class="col-sm-4">Quantity Received</dt>
                        <dd class="col-sm-8">{{ $stockEntry->quantity_received }}</dd>
                        <dt class="col-sm-4">Date Received</dt>
                        <dd class="col-sm-8">{{ $stockEntry->date_received }}</dd>
                        <dt class="col-sm-4">Comments</dt>
                        <dd class="col-sm-8">{{ $stockEntry->comments }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('stock-entries.edit', $stockEntry->entry_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('stock-entries.destroy', $stockEntry->entry_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('stock-entries.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
