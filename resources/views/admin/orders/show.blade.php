@extends('admin.layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Детали заказа</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Список заказов</a></li>
                        <li class="breadcrumb-item active">Детали</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card-footer">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад к списку</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Информация о заказе</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $order->order_id }}</dd>
                        <dt class="col-sm-4">Организация</dt>
                        <dd class="col-sm-8">{{ $order->organization->name }}</dd>
                        <dt class="col-sm-4">Склад</dt>
                        <dd class="col-sm-8">{{ $order->warehouse->name }}</dd>
                        <dt class="col-sm-4">Тип</dt>
                        <dd class="col-sm-8">{{ $order->type }}</dd>
                        <dt class="col-sm-4">Маркетплейс</dt>
                        <dd class="col-sm-8">{{ $order->marketplace }}</dd>
                        <dt class="col-sm-4">Статус</dt>
                        <dd class="col-sm-8">{{ $order->status }}</dd>
                        <dt class="col-sm-4">Комментарии продавца</dt>
                        <dd class="col-sm-8">{{ $order->seller_comments }}</dd>
                        <dt class="col-sm-4">Комментарии склада</dt>
                        <dd class="col-sm-8">{{ $order->warehouse_comments }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header d-flex">
                    <h3 class="card-title pr-5">Продукты</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Добавить продукт</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Количество</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <td>{{ $orderDetail->product->product_id }}</td>
                                <td>{{ $orderDetail->product->name }}</td>
                                <td>{{ $orderDetail->quantity_ordered }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-product" data-id="{{ $orderDetail->detail_id }}">Удалить</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Задачи</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Тип</th>
                            <th>Статус</th>
                            <th>Комментарии</th>
                            <th>Назначено</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->task_id }}</td>
                                <td>{{ $task->task_type }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->comments }}</td>
                                <td>{{ $task->assignedTo->username }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addProductForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Добавить продукт</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                        <div class="mb-3 d-flex">
                            <div class="pr-5 add_product">
                                <label for="product_id" class="form-label">Продукт</label>
                                <select class="form-control select2" id="product_id" name="product_id">
                                </select>
                            </div>

                            <button type="button" class="btn btn-success" id="showCreateProductModal">Создать продукт</button>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_ordered" class="form-label">Количество</label>
                            <input type="number" class="form-control" id="quantity_ordered" name="quantity_ordered">
                        </div>
                        <div class="mb-3">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Добавить продукт</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Product Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createProductForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Создать продукт</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Название продукта</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Количество на складе</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="article" class="form-label">Артикул</label>
                            <input type="text" class="form-control" id="article" name="article">
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Бренд</label>
                            <input type="text" class="form-control" id="brand" name="brand">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Цвет</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Вес</label>
                            <input type="text" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="mb-3">
                            <label for="manufacturer" class="form-label">Производитель</label>
                            <input type="text" class="form-control" id="manufacturer" name="manufacturer">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Местоположение</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Создать продукт</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#product_id').select2({
                dropdownParent: $('#addProductModal'),
                ajax: {
                    url: '{{ route("orders.searchProductsAjax") }}',
                    dataType: 'json',
                    delay: 250,
                    async: true,
                    cache: true,
                    data: function (params) {
                        return {
                            text: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                },
                minimumInputLength: 2,
                placeholder: "Выберите продукт",
                language: "ru",
            });

            $('#product_id').on('select2:select', function (e) {
                var data = e.params.data;
                console.log('Выбран продукт:', data);
                $(this).val(data.id).trigger('change');
            });

            $('#addProductForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("orders.addProductToOrderAjax", $order->order_id) }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#addProductModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Ошибка при добавлении продукта.');
                        }
                    },
                    error: function () {
                        alert('Ошибка при добавлении продукта.');
                    }
                });
            });

            // Обработчик формы создания продукта
            $('#createProductForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("orders.storeProductAjax") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#createProductModal').modal('hide');
                            var newOption = new Option(response.product.name, response.product.product_id, true, true);
                            $('#product_id').append(newOption).trigger('change');
                            $('#addProductModal').modal('show');
                        } else {
                            alert('Ошибка при создании продукта.');
                        }
                    },
                    error: function () {
                        alert('Ошибка при создании продукта.');
                    }
                });
            });

            $('#showCreateProductModal').on('click', function() {
                console.log('Попытка закрыть модальное окно');

                $('#addProductModal').hide();
                $(".modal-backdrop").fadeOut();

                console.log('закроет все открытые модальные окна');
                setTimeout(function() {
                    console.log('Открытие модального окна создания продукта');
                    $('#createProductModal').modal('show');
                }, 500);
            });

            $('#createProductModal').on('hidden.bs.modal', function() {
                $('#addProductModal').modal('show');
            });

            $(document).on('click', '.remove-product', function () {
                var detailId = $(this).data('id');

                $.ajax({
                    url: '{{ route("orders.removeProductFromOrderAjax", $order->order_id) }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        detail_id: detailId
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Ошибка при удалении продукта.');
                        }
                    },
                    error: function () {
                        alert('Ошибка при удалении продукта.');
                    }
                });
            });
        });
    </script>
@endsection
