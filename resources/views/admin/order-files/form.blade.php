@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($orderFile) ? 'Edit' : 'Create' }} Order File</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($orderFile) ? route('order-files.update', $orderFile->file_id) : route('order-files.store') }}" method="POST">
                        @csrf
                        @if(isset($orderFile))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="task_id" class="form-label">Task</label>
                            <select class="form-control" id="task_id" name="task_id">
                                @foreach($tasks as $task)
                                    <option value="{{ $task->task_id }}" {{ (isset($orderFile) && $orderFile->task_id == $task->task_id) ? 'selected' : '' }}>{{ $task->task_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="uploaded_by" class="form-label">Uploaded By</label>
                            <select class="form-control" id="uploaded_by" name="uploaded_by">
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}" {{ (isset($orderFile) && $orderFile->uploaded_by == $user->user_id) ? 'selected' : '' }}>{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file_path" class="form-label">File Path</label>
                            <input type="text" class="form-control" id="file_path" name="file_path" value="{{ old('file_path', $orderFile->file_path ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="file_type" class="form-label">File Type</label>
                            <input type="text" class="form-control" id="file_type" name="file_type" value="{{ old('file_type', $orderFile->file_type ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="uploaded_at" class="form-label">Uploaded At</label>
                            <input type="datetime-local" class="form-control" id="uploaded_at" name="uploaded_at" value="{{ old('uploaded_at', isset($orderFile->uploaded_at) ? $orderFile->uploaded_at->format('Y-m-d\TH:i') : '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($orderFile) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
