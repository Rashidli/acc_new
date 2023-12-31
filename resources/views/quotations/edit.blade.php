@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('quotations.update', $quotation->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$quotation->quotation_number}}</h4>
                        <div class="row">

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Quotation nömrəsi</label>
                                    <input value="{{$quotation->quotation_number}}" class="form-control" type="text" name="quotation_number">
                                    @if($errors->first('quotation_number')) <small class="form-text text-danger">{{$errors->first('quotation_number')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Müəssisə adı</label>
                                    <select class="form-control js-example-basic-single" type="text" name="institution" id="company">
                                        <option selected disabled>----- </option>
                                        @foreach($ins as $c)
                                            <option data-contract="{{$c->contract}}" value="{{$c->title}}" {{$quotation->institution == $c->title ? 'selected' : ''}}>{{$c->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('institution')) <small class="form-text text-danger">{{$errors->first('institution')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Müqavilə</label>
                                    <input value="{{$quotation->contract}}" class="form-control" type="text" name="contract" id="contract">
                                    @if($errors->first('contract')) <small class="form-text text-danger">{{$errors->first('contract')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Tarixi</label>
                                    <input value="{{$quotation->date}}" class="form-control" type="date" name="date">
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
                                            <th>Qiyməti</th>
                                            <th>-</th>
                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="quotation_products">
                                        @forelse($quotation->products as $product)
                                            <tr data-repeater-item>
                                                <td>
                                                    <select required name="product_id" class="electron_invoice_select">
                                                        <option selected disabled>----- </option>
                                                        @foreach($products as $availableProduct)
                                                            <option {{ $product->id == $availableProduct->id ? 'selected' : '' }}
                                                                    value="{{ $availableProduct->id }}" data-unit="{{ $availableProduct->unit }}"
                                                                    data-code="{{ $availableProduct->code }}">{{ $availableProduct->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required name="unit" value="{{ $product->pivot->unit }}" class="form-control unit"></td>
                                                <td><input required name="code" value="{{ $product->pivot->code }}" class="form-control code"></td>
                                                <td><input required name="price" value="{{ $product->pivot->price }}" class="form-control"></td>
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
                                    <select class="form-control js-example-basic-single" type="text" name="status" id="status">
                                        <option value="1" {{$quotation->status == 1 ? 'selected' : ''}}>Pending</option>
                                        <option value="2" {{$quotation->status == 2 ? 'selected' : ''}}>Approved</option>
                                        <option value="3" {{$quotation->status == 3 ? 'selected' : ''}}>Cancelled</option>
                                    </select>
                                    @if($errors->first('institution')) <small class="form-text text-danger">{{$errors->first('institution')}}</small> @endif
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
        $('#company').change(function(){

            var selectedOption = $(this).find(':selected');

            var contractValue = selectedOption.data('contract');

            $('#contract').val(contractValue);
        });

        // Add an onchange event listener to the .electron_invoice_select using jQuery
        $(document).on('change', '.electron_invoice_select', function () {
            // Get the selected option
            var selectedOption = $(this).find(':selected');
            // Get the value of the data-code and data-unit attributes
            var codeValue = selectedOption.data('code');
            var unitValue = selectedOption.data('unit');
            // Find the corresponding code and unit inputs directly within the same table row
            var codeInput = $(this).closest('tr').find('.code');
            var unitInput = $(this).closest('tr').find('.unit');
            // Set the value of the code and unit inputs
            codeInput.val(codeValue);
            unitInput.val(unitValue);
        });
    });
</script>
