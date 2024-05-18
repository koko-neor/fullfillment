@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order File</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('order-files.index') }}">Order Files</a></li>
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
                    <h3 class="card-title">Order File Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $orderFile->file_id }}</dd>
                        <dt class="col-sm-4">Task</dt>
                        <dd class="col-sm-8">{{ $orderFile->task_id }}</dd>
                        <dt class="col-sm-4">Uploaded By</dt>
                        <dd class="col-sm-8">{{ $orderFile->uploaded_by }}</dd>
                        <dt class="col-sm-4">File Path</dt>
                        <dd class="col-sm-8">{{ $orderFile->file_path }}</dd>
                        <dt class="col-sm-4">File Type</dt>
                        <dd class="col-sm-8">{{ $orderFile->file_type }}</dd>
                        <dt class="col-sm-4">Uploaded At</dt>
                        <dd class="col-sm-8">{{ $orderFile->uploaded_at }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('order-files.edit', $orderFile->file_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('order-files.destroy', $orderFile->file_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('order-files.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
