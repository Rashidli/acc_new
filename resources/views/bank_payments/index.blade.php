@include('includes.header')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body " >
                                @if(session('message'))
                                    <div class="alert alert-success">{{session('message')}}</div>
                                @endif
                                <h4 class="card-title">Bank ödənişləri</h4>

                                    <br>
                                    <br>

                                    <form enctype="multipart/form-data" method="post" id="your-form-id">
                                        @csrf
                                        <div class="table-container repeater">
                                            <table>
                                                <thead>
                                                <tr>

                                                    <th>Elek qaimə</th>
                                                    <th>Debet</th>
                                                    <th>Kredit</th>
                                                    <th>Müəssisə</th>
                                                    <th>Tarix</th>
                                                    <th>Əsas\ƏDV</th>
                                                    <th>Ödəniş</th>
                                                    <th>Bank</th>
                                                    <th>-</th>

                                                </tr>
                                                </thead>
                                                <tbody data-repeater-list="bank_payments">
                                                @if(count($bank_payments) > 0)
                                                    @foreach($bank_payments as $value)

                                                        <tr data-repeater-item>

                                                            <td>
                                                                <select required name="electron_invoice" class="electron_invoice_select">
                                                                    <option selected disabled>----- </option>
                                                                    @foreach($purchases as $purchase)
                                                                        <option value="{{$purchase->electron_invoice}}" data-id="{{$purchase->id}}" data-purchase="{{$purchase->company}}" {{$purchase->electron_invoice == $value->electron_invoice ? 'selected' : ''}}>{{$purchase->electron_invoice}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                                            <input required name="purchase_id" type="hidden" value="{{$value->purchase_id}}" class="form-control purchase_id">
                                                            <td><input required name="debet" value="{{$value->debet}}" class="form-control debet" ></td>
                                                            <td><input required name="credit" value="{{$value->credit}}" class="form-control credit" ></td>
                                                            <td><input required name="company" value="{{$value->company}}" class="form-control company"></td>
                                                            <td><input required name="date" value="{{$value->date}}" class="form-control" type="date"></td>
                                                            <td>
                                                                <select required name="payment_type" class="js-example-basic-single_bank">
                                                                    <option selected disabled>----- </option>
                                                                    <option value="1" {{$value->payment_type == 1 ? 'selected'  : ''}}>Əsas</option>
                                                                    <option value="2"  {{$value->payment_type == 2 ? 'selected'  : ''}}>ƏDV</option>
                                                                </select>
                                                            </td>
                                                            <td><input required name="payment_amount" value="{{$value->payment_amount}}" class="form-control"></td>
                                                            <td>
                                                                <select required name="bank" class="js-example-basic-single">
                                                                    <option selected disabled>----- </option>
                                                                    @foreach($banks as $bank)
                                                                        <option value="{{$bank->title}}" {{$value->bank == $bank->title ? 'selected' : ''}}>{{$bank->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr data-repeater-item>

                                                        <td>
                                                            <select required name="electron_invoice" class="electron_invoice_select">
                                                                <option selected disabled>----- </option>
                                                                @foreach($purchases as $purchase)
                                                                    <option value="{{$purchase->electron_invoice}}" data-id="{{$purchase->id}}" data-purchase="{{$purchase->company}}">{{$purchase->electron_invoice}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <input required name="purchase_id" type="hidden" value="" class="form-control purchase_id">
                                                        <input type="hidden" name="id" value="">
                                                        <td><input required name="debet" value="" class="form-control debet" ></td>
                                                        <td><input required name="credit" value="" class="form-control credit" ></td>
                                                        <td><input required name="company" value="" class="form-control company"></td>
                                                        <td><input required name="date" value="" class="form-control" type="date"></td>
                                                        <td>
                                                            <select required name="payment_type" class="js-example-basic-single_bank">
                                                                <option selected disabled>----- </option>
                                                                <option value="1" >Əsas</option>
                                                                <option value="2"  >ƏDV</option>
                                                            </select>
                                                        </td>
                                                        <td><input required name="payment_amount" value="" class="form-control"></td>
                                                        <td>
                                                            <select required name="bank" class="js-example-basic-single">
                                                                <option selected disabled>----- </option>
                                                                @foreach($banks as $bank)
                                                                    <option value="{{$bank->title}}" >{{$bank->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                                        </td>

                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>
                                            <button data-repeater-create class="btn btn-success" type="button">+</button>
                                        </div>
                                        <div style="display: flex">
                                            <button type="button" id="submit_button" class="btn btn-primary">Yadda saxla</button>
                                            <div id="loading-message" class="alert alert-info" role="alert" style="display: none;  max-width: 200px">
                                                <strong>Loading...</strong>
                                            </div>
                                            <div id="success-message" class="alert alert-success" role="alert" style="display: none; max-width: 200px">
                                                <strong>Data saved successfully</strong>
                                            </div>
                                        </div>
                                    </form>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@include('includes.footer')
<!-- Add the following script to your HTML -->

