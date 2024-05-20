@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Organizations</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('organizations.create') }}" class="btn btn-primary">Добавить Organization</a>
                </div>
                <div class="card-body">
                    <table id="organizations-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Адрес</th>
                            <th>Contact Number</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($organizations as $organization)
                            <tr>
                                <td>{{ $organization->organization_id }}</td>
                                <td>{{ $organization->name }}</td>
                                <td>{{ $organization->type }}</td>
                                <td>{{ $organization->address }}</td>
                                <td>{{ $organization->contact_number }}</td>
                                <td>
                                    <a href="{{ route('organizations.show', $organization) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('organizations.edit', $organization->organization_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('organizations.destroy', $organization->organization_id) }}" method="POST" style="display:inline-block;">
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
            $('#organizations-table').DataTable();
        });
    </script>
@endsection
