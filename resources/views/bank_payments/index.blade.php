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

{{--                                    <a href="" class="btn btn-primary edit_form" style="margin-right: 15px" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">--}}
{{--                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>--}}
{{--                                        </svg></a>--}}
{{--                                    <form action="" method="post" style="display: inline-block" class="delete_form">--}}
{{--                                        {{ method_field('DELETE') }}--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" disabled class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">--}}
{{--                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>--}}
{{--                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>--}}
{{--                                            </svg></button>--}}
{{--                                    </form>--}}
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

