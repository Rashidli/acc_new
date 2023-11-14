@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('expenses.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Əlavə et</h4>
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Sale order</label>
                                        <select class="form-control js-example-basic-single" type="text" name="sale_id" id="sale_id">
                                            <option selected disabled>----- </option>
                                                @foreach($sale_orders as $c)
                                                    <option value="{{$c->id}}" data-company="{{$c->company}}" {{old('sale_id') == $c->id ? 'selected' : ''}}>{{$c->sale_number}}</option>
                                                @endforeach
                                        </select>
                                        @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Müəssisə adı</label>
                                        <input value="{{old('company')}}" class="form-control company" type="text" name="company">
                                        @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Anbar adı</label>
                                        <select class="form-control js-example-basic-single" type="text" name="warehouse_name" id="corporate_name">
                                            <option selected disabled>----- </option>
                                            @foreach($wares as $c)
                                                <option value="{{$c->title}}" {{old('warehouse_name') == $c->title ? 'selected' : ''}}>{{$c->title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->first('warehouse_name')) <small class="form-text text-danger">{{$errors->first('warehouse_name')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Tarixi</label>
                                        <input value="{{old('date')}}" class="form-control" type="date" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-12">

{{--                                    @livewire('products')--}}

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
                                                <tr data-repeater-item>

                                                    <td>
                                                        <select required name="product_id" class="electron_invoice_select">

                                                        </select>
                                                    </td>
                                                    <td><input required name="unit" value="" class="form-control unit"></td>
                                                    <td><input required name="code" value="" class="form-control code"></td>
                                                    <td><input required name="quantity" value="" class="form-control quantity"></td>

                                                    <td>
                                                        <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                                    </td>

                                                </tr>


                                            </tbody>
                                        </table>
                                        <br>
                                        <br>
                                        <button data-repeater-create class="btn btn-success" type="button">+</button>
                                    </div>
                                    <br>
                                    <br>

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
                        // Append product to product_list
                        var newRow = $('<tr data-repeater-item>');
                        newRow.append('<td><select required name="product_id" class="electron_invoice_select"></select></td>');
                        newRow.append('<td><input required name="unit" value="' + product.unit + '" class="form-control unit"></td>');
                        newRow.append('<td><input required name="code" value="' + product.code + '" class="form-control code"></td>');
                        newRow.append('<td><input required name="quantity" value="' + product.pivot.quantity + '" class="form-control quantity"></td>');
                        newRow.append('<td><button data-repeater-delete class="btn btn-danger" type="button">-</button></td>');
                        product_list.append(newRow);

                        // Append the option to the dynamically created productSelect
                        var productSelectElement = newRow.find('.electron_invoice_select');


                        $.each(response, function(index, inner_product) {
                            var isSelected = product.id === inner_product.id;
                            var option = $('<option>', {
                                value: inner_product.id,
                                'data-unit': inner_product.unit,
                                'data-code': inner_product.code,
                                'data-quantity': inner_product.pivot.quantity,

                                selected: isSelected
                            }).text(inner_product.title);

                            productSelectElement.append(option);
                            $('.electron_invoice_select').select2();
                        });

                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
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
                    productSelect.empty(); // Clear existing options

                    // Add the default "-----" option
                    var defaultOption = $('<option>', {
                        selected: true,
                        disabled: true
                    }).text('-----');
                    productSelect.append(defaultOption);

                    // Add new options based on the response
                    $.each(response, function(index, product) {
                        var option = $('<option>', {
                            value: product.id,
                            'data-unit': product.unit,
                            'data-code': product.code,
                            'data-quantity': product.pivot.quantity,
                        }).text(product.title);

                        productSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                }
            });
        }

        $('#sale_id').change(getSaleProducts);
        $('.repeater').on('click', '[data-repeater-create]', function() {
            getProduct();
        });

        $(document).on('change', '.electron_invoice_select', function () {
            // Get the selected option
            var selectedOption = $(this).find(':selected');
            // Get the value of the data-code and data-unit attributes
            var codeValue = selectedOption.data('code');
            var unitValue = selectedOption.data('unit');
            var priceValue = selectedOption.data('quantity');
            // Find the corresponding code and unit inputs directly within the same table row
            var codeInput = $(this).closest('tr').find('.code');
            var unitInput = $(this).closest('tr').find('.unit');
            var priceInput = $(this).closest('tr').find('.quantity');

            // Set the value of the code and unit inputs
            codeInput.val(codeValue);
            unitInput.val(unitValue);
            priceInput.val(priceValue);
        });

    })
</script>
