@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Warehouses</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Добавить Warehouse</a>
                </div>
                <div class="card-body">
                    <table id="warehouses-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Organization</th>
                            <th>Name</th>
                            <th>Добавитьress</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($warehouses as $warehouse)
                            <tr>
                                <td>{{ $warehouse->warehouse_id }}</td>
                                <td>{{ $warehouse->organization_id }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->Добавитьress }}</td>
                                <td>
                                    <a href="{{ route('warehouses.show', $warehouse) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('warehouses.edit', $warehouse->warehouse_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('warehouses.destroy', $warehouse->warehouse_id) }}" method="POST" style="display:inline-block;">
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
            $('#warehouses-table').DataTable();
        });
    </script>
@endsection
