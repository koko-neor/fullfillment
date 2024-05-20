@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($warehouse) ? 'Создать' : 'Обновить' }} Склад</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($warehouse) ? route('warehouses.update', $warehouse->warehouse_id) : route('warehouses.store') }}" method="POST">
                        @csrf
                        @if(isset($warehouse))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="organization_id" class="form-label">Organization</label>
                            <select class="form-control" id="organization_id" name="organization_id">
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->organization_id }}" {{ (isset($warehouse) && $warehouse->organization_id == $organization->organization_id) ? 'selected' : '' }}>{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $warehouse->name ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $warehouse->address ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($warehouse) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
