@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('expenses.update', $expense->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$expense->expense_number}}</h4>
                        <div class="row">

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Sale order</label>
                                    <select class="form-control js-example-basic-single" type="text" name="sale_id" id="sale_id">
                                        <option selected disabled>----- </option>
                                        @foreach($sale_orders as $c)
                                            <option data-company="{{$c->company}}" value="{{$c->id}}" {{$expense->sale_id == $c->id ? 'selected' : ''}}>{{$c->sale_number}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('sale_id')) <small class="form-text text-danger">{{$errors->first('sale_id')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Müəssisə adı</label>
                                    <input value="{{$expense->company}}" class="form-control company" type="text" name="company">
                                    @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Anbar adı</label>
                                    <select class="form-control js-example-basic-single" type="text" name="warehouse_name" id="corporate_name">
                                        <option selected disabled>----- </option>
                                        @foreach($wares as $c)
                                            <option value="{{$c->title}}" {{$expense->warehouse_name == $c->title ? 'selected' : ''}}>{{$c->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('warehouse_name')) <small class="form-text text-danger">{{$errors->first('warehouse_name')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Tarixi</label>
                                    <input value="{{$expense->date}}" class="form-control" type="date" name="date">
                                    @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <br>
                                <br>
                                <h4 class="card-title">Məhsullar</h4>

                                <div class="quotation_table repeater">
                                    <table>
                                        <thead>
                                        <tr>

                                            <th>Məhsul</th>
                                            <th>Vahidi</th>
                                            <th>Kodu</th>
                                            <th>Miqdarı</th>
                                            <th>-</th>

                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="expense_products" class="t-body">
                                        @forelse($expense->products as $product)
                                            <tr data-repeater-item>
                                                <td>
                                                    <select required name="product_id" class="electron_invoice_select">
                                                        <option selected disabled>----- </option>
                                                        @foreach($products as $availableProduct)
                                                            <option {{ $product->id == $availableProduct->id ? 'selected' : '' }}
                                                                    value="{{ $availableProduct->id }}" data-unit="{{ $availableProduct->unit }}"
                                                                    data-code="{{ $availableProduct->code }}" data-quantity="{{$availableProduct->pivot->quantity}}">{{ $availableProduct->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required name="unit" value="{{ $product->unit }}" class="form-control unit"></td>
                                                <td><input required name="code" value="{{ $product->code }}" class="form-control code"></td>
                                                <td><input required name="quantity" value="{{ $product->pivot->quantity }}" class="form-control quantity"></td>
                                                <td style="display: none"><input required name="price" value="{{ $product->pivot->price }}" class="form-control price"></td>
                                                <td>
                                                    <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <!-- Display a default row if there are no associated products -->
                                        @endforelse


                                        </tbody>
                                    </table>
                                    <br>
                                    <br>
                                    <button data-repeater-create class="btn btn-success" type="button">+</button>
                                </div>
                                <br>
                                <br>

                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control js-example-basic-single" type="text" name="status">
                                        <option value="5" {{$expense->status == 5 ? 'selected' : ''}}>Send</option>
                                        <option value="4" {{$expense->status == 4 ? 'selected' : ''}}>Delivered</option>
                                    </select>
                                    @if($errors->first('status')) <small class="form-text text-danger">{{$errors->first('status')}}</small> @endif
                                </div>
                            </div>

                            <div class="mt-6">
                                <button class="btn btn-primary">Yadda saxla</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@include('includes.footer')
<script>
    $(document).ready(function (){

        $('#sale_id').change(function (){

            var selectedOption = $(this).find(':selected');
            var company = selectedOption.data('company');
            $('.company').val(company);

        })




        function getSaleProducts() {
            var selectedOption = $(this).find(':selected');
            var idValue = selectedOption.val();

            $.ajax({
                type: 'POST',
                url: '/getSaleProducts',
                data: { id: idValue },
                success: function(response) {
                    var product_list = $('.t-body');
                    product_list.empty();

                    var productSelect = $('.electron_invoice_select');
                    productSelect.empty();

                    var defaultOption = $('<option>', {
                        selected: true,
                        disabled: true
                    }).text('-----');
                    productSelect.append(defaultOption);

                    $.each(response, function(index, product) {
                        var newRow = $('<tr data-repeater-item>');
                        newRow.append('<td><select required name="product_id" class="electron_invoice_select"></select></td>');
                        newRow.append('<td><input required name="unit" value="' + product.unit + '" class="form-control unit"></td>');
                        newRow.append('<td><input required name="code" value="' + product.code + '" class="form-control code"></td>');
                        newRow.append('<td><input required name="quantity" value="' + product.pivot.quantity + '" class="form-control quantity"></td>');
                        newRow.append('<td style="display: none"><input required name="price" value="' + product.pivot.price + '" class="form-control price"></td>');
                        newRow.append('<td><button data-repeater-delete class="btn btn-danger" type="button">-</button></td>');
                        product_list.append(newRow);

                        var productSelectElement = newRow.find('.electron_invoice_select');


                        $.each(response, function(index, inner_product) {
                            var isSelected = product.id === inner_product.id;
                            var option = $('<option>', {
                                value: inner_product.id,
                                'data-unit': inner_product.unit,
                                'data-code': inner_product.code,
                                'data-quantity': inner_product.pivot.quantity,
                                'data-price': inner_product.pivot.price,

                                selected: isSelected
                            }).text(inner_product.title);

                            productSelectElement.append(option);
                            $('.electron_invoice_select').select2();
                        });
                        $('.repeater').repeater();
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        }

        function getProduct(){

            var selectedOption = $('#sale_id').find(':selected');
            var idValue = selectedOption.val();


            $.ajax({
                type: 'POST',
                url: '/getSaleProducts',
                data: { id: idValue },
                success: function(response) {

                    var newRow = $('.repeater').find('tbody tr').last();

                    var productSelect = newRow.find('.electron_invoice_select');
                    productSelect.empty();

                    var defaultOption = $('<option>', {
                        selected: true,
                        disabled: true
                    }).text('-----');
                    productSelect.append(defaultOption);

                    $.each(response, function(index, product) {
                        var option = $('<option>', {
                            value: product.id,
                            'data-unit': product.unit,
                            'data-code': product.code,
                            'data-quantity': product.pivot.quantity,
                            'data-price': product.pivot.price,
                        }).text(product.title);

                        productSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        }

        $('#sale_id').change(getSaleProducts);
        $('.repeater').on('click', '[data-repeater-create]', function() {
            getProduct();
        });

        $(document).on('change', '.electron_invoice_select', function () {

            var selectedOption = $(this).find(':selected');

            var codeValue = selectedOption.data('code');
            var unitValue = selectedOption.data('unit');
            var quantityValue = selectedOption.data('quantity');
            var priceValue = selectedOption.data('price');

            var codeInput = $(this).closest('tr').find('.code');
            var unitInput = $(this).closest('tr').find('.unit');
            var quantityInput = $(this).closest('tr').find('.quantity');
            var priceInput = $(this).closest('tr').find('.price');

            codeInput.val(codeValue);
            unitInput.val(unitValue);
            quantityValue.val(quantityInput);
            priceValue.val(priceInput);
        });

    })


</script>
