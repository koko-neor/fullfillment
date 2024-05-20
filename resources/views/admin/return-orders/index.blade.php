@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Return Заявки</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('return-orders.create') }}" class="btn btn-primary">Добавить Return Заявка</a>
                </div>
                <div class="card-body">
                    <table id="return-orders-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Detail ID</th>
                            <th>Reason</th>
                            <th>Date Returned</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($returnOrders as $returnOrder)
                            <tr>
                                <td>{{ $returnOrder->return_id }}</td>
                                <td>{{ $returnOrder->order_detail_id }}</td>
                                <td>{{ $returnOrder->reason }}</td>
                                <td>{{ $returnOrder->date_returned }}</td>
                                <td>
                                    <a href="{{ route('return-orders.show', $returnOrder) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('return-orders.edit', $returnOrder->return_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('return-orders.destroy', $returnOrder->return_id) }}" method="POST" style="display:inline-block;">
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
            $('#return-orders-table').DataTable();
        });
    </script>
@endsection
