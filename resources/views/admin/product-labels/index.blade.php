@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Labels</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('product-labels.create') }}" class="btn btn-primary">Добавить Product Label</a>
                </div>
                <div class="card-body">
                    <table id="product-labels-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Barcode</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productLabels as $productLabel)
                            <tr>
                                <td>{{ $productLabel->label_id }}</td>
                                <td>{{ $productLabel->product_id }}</td>
                                <td>{{ $productLabel->barcode }}</td>
                                <td>{{ $productLabel->type }}</td>
                                <td>
                                    <a href="{{ route('product-labels.show', $productLabel) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('product-labels.edit', $productLabel->label_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('product-labels.destroy', $productLabel->label_id) }}" method="POST" style="display:inline-block;">
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
            $('#product-labels-table').DataTable();
        });
    </script>
@endsection
