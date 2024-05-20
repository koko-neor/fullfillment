@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Organization Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('organizations.index') }}">Organizations</a></li>
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
                    <h3 class="card-title">Organization Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $organization->organization_id }}</dd>
                        <dt class="col-sm-4">Name</dt>
                        <dd class="col-sm-8">{{ $organization->name }}</dd>
                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ $organization->type }}</dd>
                        <dt class="col-sm-4">Добавитьress</dt>
                        <dd class="col-sm-8">{{ $organization->Добавитьress }}</dd>
                        <dt class="col-sm-4">Contact Number</dt>
                        <dd class="col-sm-8">{{ $organization->contact_number }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('organizations.edit', $organization->organization_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('organizations.destroy', $organization->organization_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('organizations.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
