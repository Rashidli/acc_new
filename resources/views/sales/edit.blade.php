@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('sales.update', $sale->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$sale->sale_number}}</h4>
                        <div class="row">

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Satış nömrəsi</label>
                                    <input value="{{$sale->sale_number}}" class="form-control" type="text" name="sale_number">
                                    @if($errors->first('sale_number')) <small class="form-text text-danger">{{$errors->first('sale_number')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Quotation</label>
                                    <select class="form-control js-example-basic-single" type="text" name="quotation_id" id="institution">
                                        <option selected disabled>----- </option>
                                        @foreach($quotations as $c)
                                            <option data-contract="{{$c->contract}}" data-company="{{$c->company}}" value="{{$c->id}}" {{$sale->quotation_id == $c->id ? 'selected' : ''}}>{{$c->quotation_number}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('quotation_id')) <small class="form-text text-danger">{{$errors->first('quotation_id')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Müəssisə adı</label>
                                    <input value="{{$sale->company}}" class="form-control" type="text" name="company" id="company">
                                    @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
                                </div>
                            </div><div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Müqavilə</label>
                                    <input value="{{$sale->contract}}" class="form-control" type="text" name="contract" id="contract">
                                    @if($errors->first('contract')) <small class="form-text text-danger">{{$errors->first('contract')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Tarixi</label>
                                    <input value="{{$sale->date}}" class="form-control" type="date" name="date">
                                    @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <div>
                                        <label class="col-form-label">ƏDV dərəcəsi</label>
                                    </div>
                                    <div>
                                        <input class="tax" {{$sale->tax == 'on' ? 'checked' : ''}}   type="checkbox" name="tax">
                                    </div>
                                    @if($errors->first('tax')) <small class="form-text text-danger">{{$errors->first('tax')}}</small> @endif
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
                                            <th>Qiyməti</th>
                                            <th>Miqdarı</th>
                                            <th>Cəm</th>
                                            <th>-</th>
                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="sale_products">
                                        @forelse($sale->products as $product)
                                            <tr data-repeater-item>
                                                <td>
                                                    <select required name="product_id" class="electron_invoice_select">
                                                        <option selected disabled>----- </option>
                                                        @foreach($products as $availableProduct)
                                                            <option {{ $product->id == $availableProduct->id ? 'selected' : '' }}
                                                                    value="{{ $availableProduct->id }}" data-unit="{{ $availableProduct->unit }}"
                                                                    data-code="{{ $availableProduct->code }}" data-price="{{$availableProduct->pivot->price}}">{{ $availableProduct->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required name="unit" value="{{ $product->pivot->unit }}" class="form-control unit"></td>
                                                <td><input required name="code" value="{{ $product->pivot->code }}" class="form-control code"></td>
                                                <td><input required name="price" value="{{ $product->pivot->price }}" class="form-control price"></td>
                                                <td><input required name="quantity" value="{{ $product->pivot->quantity }}" class="form-control quantity"></td>
                                                <td><input required name="sub_total" value="{{ $product->pivot->sub_total }}" class="form-control sub_total"></td>
                                                <td>
                                                    <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <!-- Display a default row if there are no associated products -->
                                        @endforelse

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: right;">Cəm:</td>
                                                <td><span class="total"> {{$sale->sub_total}}</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right;">ƏDV (18%):</td>
                                                <td><span class="tax-amount">{{$sale->tax_fee}}</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right;">Yekun:</td>
                                                <td><span class="total-with-tax">{{$sale->total_amount}}</span></td>
                                            </tr>
                                            <input type="hidden" value="{{$sale->tax_fee}}" name="tax_fee" class="tax-amount">
                                            <input type="hidden" value="{{$sale->sub_total}}" name="sub_total" class="total">
                                            <input type="hidden" value="{{$sale->total_amount}}" name="total_amount" class="total-with-tax">
                                        </tfoot>
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
                                    <select class="form-control js-example-basic-single" type="text" name="status" id="status">
                                        <option value="1" {{$sale->status == 1 ? 'selected' : ''}}>Pending</option>
                                        <option value="2" {{$sale->status == 2 ? 'selected' : ''}}>Approved</option>
                                        <option value="3" {{$sale->status == 3 ? 'selected' : ''}}>Cancelled</option>
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
    $(document).ready(function(){


        function handleInstitutionChange() {

            var selectedOption = $(this).find(':selected');
            var idValue = selectedOption.val();

            var contractValue = selectedOption.data('contract');
            var institutionValue = selectedOption.data('company');

            $('#contract').val(contractValue);
            $('#company').val(institutionValue);

            $.ajax({
                type: 'POST',
                url: '/getQuotationProducts',
                data: { id: idValue },
                success: function(response) {

                    var productSelect = $('.electron_invoice_select');

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
                            'data-price': product.pivot.price,
                        }).text(product.title);

                        productSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                }
            });

        }

        function getProduct(){

            var selectedOption = $('#institution').find(':selected');
            var idValue = selectedOption.val();

            $.ajax({
                type: 'POST',
                url: '/getQuotationProducts',
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
                            'data-price': product.pivot.price,
                        }).text(product.title);

                        productSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                }
            });
        }

        $('#institution').change(handleInstitutionChange);
        $('.repeater').on('click', '[data-repeater-create]', function() {

            getProduct();

        });



        // Add an onchange event listener to the .electron_invoice_select using jQuery
        $(document).on('change', '.electron_invoice_select', function () {
            // Get the selected option
            var selectedOption = $(this).find(':selected');
            // Get the value of the data-code and data-unit attributes
            var codeValue = selectedOption.data('code');
            var unitValue = selectedOption.data('unit');
            var priceValue = selectedOption.data('price');
            // Find the corresponding code and unit inputs directly within the same table row
            var codeInput = $(this).closest('tr').find('.code');
            var unitInput = $(this).closest('tr').find('.unit');
            var priceInput = $(this).closest('tr').find('.price');

            // Set the value of the code and unit inputs
            codeInput.val(codeValue);
            unitInput.val(unitValue);
            priceInput.val(priceValue);
        });


        // Add event listeners for quantity and price input fields
        $('.repeater').on('input', '.quantity, .price', function() {
            calculateSubtotal($(this).closest('tr'));
            calculateTotal();
        });

        // Function to calculate subtotal
        function calculateSubtotal(row) {
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var price = parseFloat(row.find('.price').val()) || 0;

            var subtotal = quantity * price;

            // Set the calculated subtotal value in the sub_total input field
            row.find('.sub_total').val(subtotal.toFixed(2));
        }

        // Function to calculate total of subtotals
        function calculateTotal() {
            var total = 0;

            // Iterate through each row and sum up the subtotals
            $('.repeater tbody tr').each(function () {
                total += parseFloat($(this).find('.sub_total').val()) || 0;
            });

            // Calculate tax-related values
            var taxRate = $('input[name="tax"]').is(':checked') ? 0.18 : 0;
            var taxAmount = total * taxRate;
            var totalWithTax = total + taxAmount;

            // Set the calculated values in the tfoot
            $('.repeater tfoot .total, .repeater tfoot .tax-amount, .repeater tfoot .total-with-tax').text('0.00').val('0.00');
            $('.repeater tfoot .total').text(total.toFixed(2)).val(total.toFixed(2));
            $('.repeater tfoot .tax-amount').text(taxAmount.toFixed(2)).val(taxAmount.toFixed(2));
            $('.repeater tfoot .total-with-tax').text(totalWithTax.toFixed(2)).val(totalWithTax.toFixed(2));
        }

        // Add event listener for the "Add" button
        $('.repeater').on('click', '[data-repeater-create]', function() {
            // Add the same input event listeners for the new row
            var newRow = $(this).closest('.repeater').find('tbody tr').last();
            newRow.find('.quantity, .price').on('input', function() {
                calculateSubtotal($(this).closest('tr'));
                calculateTotal();
            });
        });

        // Add event listener for the tax checkbox
        $('input[name="tax"]').on('change', function() {
            calculateTotal();
        });

        $('.repeater').on('click', '[data-repeater-delete]', function() {
            // Remove the current row
            var deletedRow = $(this).closest('tr');
            deletedRow.remove();

            // Recalculate the total amount
            calculateTotal();
        });


    });
</script>
