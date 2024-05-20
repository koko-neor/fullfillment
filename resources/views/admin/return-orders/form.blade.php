@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($returnOrder) ? 'Edit' : 'Create' }} Return Заявка</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($returnOrder) ? route('return-orders.update', $returnOrder->return_id) : route('return-orders.store') }}" method="POST">
                        @csrf
                        @if(isset($returnOrder))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="order_detail_id" class="form-label">Order Detail ID</label>
                            <select class="form-control" id="order_detail_id" name="order_detail_id">
                                @foreach($orderDetails as $orderDetail)
                                    <option value="{{ $orderDetail->detail_id }}" {{ (isset($returnOrder) && $returnOrder->order_detail_id == $orderDetail->detail_id) ? 'selected' : '' }}>{{ $orderDetail->detail_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <input type="text" class="form-control" id="reason" name="reason" value="{{ old('reason', $returnOrder->reason ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="date_returned" class="form-label">Date Returned</label>
                            <input type="datetime-local" class="form-control" id="date_returned" name="date_returned" value="{{ old('date_returned', isset($returnOrder->date_returned) ? $returnOrder->date_returned->format('Y-m-d\TH:i') : '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($returnOrder) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
