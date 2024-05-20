@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Tasks</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('order-tasks.create') }}" class="btn btn-primary">Добавить Order Task</a>
                </div>
                <div class="card-body">
                    <table id="order-tasks-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Заявка</th>
                            <th>Assigned To</th>
                            <th>Task Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orderTasks as $orderTask)
                            <tr>
                                <td>{{ $orderTask->task_id }}</td>
                                <td>{{ $orderTask->order_id }}</td>
                                <td>{{ $orderTask->assigned_to }}</td>
                                <td>{{ $orderTask->task_type }}</td>
                                <td>{{ $orderTask->status }}</td>
                                <td>
                                    <a href="{{ route('order-tasks.show', $orderTask) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('order-tasks.edit', $orderTask->task_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('order-tasks.destroy', $orderTask->task_id) }}" method="POST" style="display:inline-block;">
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
            $('#order-tasks-table').DataTable();
        });
    </script>
@endsection
