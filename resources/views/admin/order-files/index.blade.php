@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Files</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('order-files.create') }}" class="btn btn-primary">Добавить Order File</a>
                </div>
                <div class="card-body">
                    <table id="order-files-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task</th>
                            <th>Uploaded By</th>
                            <th>File Path</th>
                            <th>File Type</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orderFiles as $orderFile)
                            <tr>
                                <td>{{ $orderFile->file_id }}</td>
                                <td>{{ $orderFile->task_id }}</td>
                                <td>{{ $orderFile->uploaded_by }}</td>
                                <td>{{ $orderFile->file_path }}</td>
                                <td>{{ $orderFile->file_type }}</td>
                                <td>{{ $orderFile->uploaded_at }}</td>
                                <td>
                                    <a href="{{ route('order-files.show', $orderFile) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('order-files.edit', $orderFile->file_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('order-files.destroy', $orderFile->file_id) }}" method="POST" style="display:inline-block;">
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
            $('#order-files-table').DataTable();
        });
    </script>
@endsection
