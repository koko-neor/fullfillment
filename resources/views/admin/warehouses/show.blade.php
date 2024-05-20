@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Warehouse Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
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
                    <h3 class="card-title">Warehouse Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $warehouse->warehouse_id }}</dd>
                        <dt class="col-sm-4">Organization</dt>
                        <dd class="col-sm-8">{{ $warehouse->organization_id }}</dd>
                        <dt class="col-sm-4">Name</dt>
                        <dd class="col-sm-8">{{ $warehouse->name }}</dd>
                        <dt class="col-sm-4">Добавитьress</dt>
                        <dd class="col-sm-8">{{ $warehouse->Добавитьress }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('warehouses.edit', $warehouse->warehouse_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('warehouses.destroy', $warehouse->warehouse_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
