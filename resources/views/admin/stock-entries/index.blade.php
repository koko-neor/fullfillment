@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Entries</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('stock-entries.create') }}" class="btn btn-primary">Добавить Stock Entry</a>
                </div>
                <div class="card-body">
                    <table id="stock-entries-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Warehouse</th>
                            <th>Quantity Received</th>
                            <th>Date Received</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($stockEntries as $stockEntry)
                            <tr>
                                <td>{{ $stockEntry->entry_id }}</td>
                                <td>{{ $stockEntry->product_id }}</td>
                                <td>{{ $stockEntry->warehouse_id }}</td>
                                <td>{{ $stockEntry->quantity_received }}</td>
                                <td>{{ $stockEntry->date_received }}</td>
                                <td>{{ $stockEntry->comments }}</td>
                                <td>
                                    <a href="{{ route('stock-entries.show', $stockEntry) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('stock-entries.edit', $stockEntry->entry_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('stock-entries.destroy', $stockEntry->entry_id) }}" method="POST" style="display:inline-block;">
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
            $('#stock-entries-table').DataTable();
        });
    </script>
@endsection
