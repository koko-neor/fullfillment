@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Storage Block Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('storage-blocks.index') }}">Storage Blocks</a></li>
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
                    <h3 class="card-title">Storage Block Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $storageBlock->block_id }}</dd>
                        <dt class="col-sm-4">Warehouse</dt>
                        <dd class="col-sm-8">{{ $storageBlock->warehouse_id }}</dd>
                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ $storageBlock->type }}</dd>
                        <dt class="col-sm-4">Location</dt>
                        <dd class="col-sm-8">{{ $storageBlock->location }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('storage-blocks.edit', $storageBlock->block_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('storage-blocks.destroy', $storageBlock->block_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('storage-blocks.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
