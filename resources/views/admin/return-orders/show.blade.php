@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Return Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('return-orders.index') }}">Return Заявки</a></li>
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
                    <h3 class="card-title">Return Order Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $returnOrder->return_id }}</dd>
                        <dt class="col-sm-4">Order Detail ID</dt>
                        <dd class="col-sm-8">{{ $returnOrder->order_detail_id }}</dd>
                        <dt class="col-sm-4">Reason</dt>
                        <dd class="col-sm-8">{{ $returnOrder->reason }}</dd>
                        <dt class="col-sm-4">Date Returned</dt>
                        <dd class="col-sm-8">{{ $returnOrder->date_returned }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('return-orders.edit', $returnOrder->return_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('return-orders.destroy', $returnOrder->return_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('return-orders.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
@endsection
