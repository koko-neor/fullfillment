@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Storage Blocks</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('storage-blocks.create') }}" class="btn btn-primary">Добавить Storage Block</a>
                </div>
                <div class="card-body">
                    <table id="storage-blocks-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Warehouse</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($storageBlocks as $storageBlock)
                            <tr>
                                <td>{{ $storageBlock->block_id }}</td>
                                <td>{{ $storageBlock->warehouse_id }}</td>
                                <td>{{ $storageBlock->type }}</td>
                                <td>{{ $storageBlock->location }}</td>
                                <td>
                                    <a href="{{ route('storage-blocks.show', $storageBlock) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('storage-blocks.edit', $storageBlock->block_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('storage-blocks.destroy', $storageBlock->block_id) }}" method="POST" style="display:inline-block;">
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
            $('#storage-blocks-table').DataTable();
        });
    </script>
@endsection
