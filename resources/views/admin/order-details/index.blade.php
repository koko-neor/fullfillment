@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('order-details.create') }}" class="btn btn-primary">Add Order Detail</a>
                </div>
                <div class="card-body">
                    <table id="order-details-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order</th>
                            <th>Product</th>
                            <th>Quantity Ordered</th>
                            <th>Label</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orderDetails as $orderDetail)
                            <tr>
                                <td>{{ $orderDetail->detail_id }}</td>
                                <td>{{ $orderDetail->order->id }}</td>
                                <td>{{ $orderDetail->product->name }}</td>
                                <td>{{ $orderDetail->quantity_ordered }}</td>
                                <td>{{ $orderDetail->label->barcode }}</td>
                                <td>
                                    <a href="{{ route('order-details.show', $orderDetail) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('order-details.edit', $orderDetail->detail_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('order-details.destroy', $orderDetail->detail_id) }}" method="POST" style="display:inline-block;">
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
            $('#order-details-table').DataTable();
        });
    </script>
@endsection
