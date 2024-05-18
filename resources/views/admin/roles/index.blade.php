@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">Add Role</a>
                </div>
                <div class="card-body">
                    <table id="roles-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->role_id }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>
                                    <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('roles.edit', $role->role_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('roles.destroy', $role->role_id) }}" method="POST" style="display:inline-block;">
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
            $('#roles-table').DataTable();
        });
    </script>
@endsection
