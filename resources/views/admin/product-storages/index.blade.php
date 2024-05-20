@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Storages</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('product-storages.create') }}" class="btn btn-primary">Добавить Product Storage</a>
                </div>
                <div class="card-body">
                    <table id="product-storages-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Block</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productStorages as $productStorage)
                            <tr>
                                <td>{{ $productStorage->storage_id }}</td>
                                <td>{{ $productStorage->product_id }}</td>
                                <td>{{ $productStorage->block_id }}</td>
                                <td>{{ $productStorage->status }}</td>
                                <td>
                                    <a href="{{ route('product-storages.show', $productStorage) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('product-storages.edit', $productStorage->storage_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('product-storages.destroy', $productStorage->storage_id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#product-storages-table').DataTable();
        });
    </script>
@endsection
