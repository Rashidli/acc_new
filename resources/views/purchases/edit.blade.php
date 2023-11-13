@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('purchases.update', $purchase->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$purchase->purchase_number}}</h4>
                        <div class="row">

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Müəssisə adı</label>
                                    <select class="form-control js-example-basic-single" type="text" name="company" id="company">
                                        <option selected disabled>----- </option>
                                        @foreach($ins as $c)
                                            <option value="{{$c->title}}" {{$purchase->company == $c->title ? 'selected' : ''}}>{{$c->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Anbar mədaxil nömrəsi</label>
                                    <select class="form-control js-example-basic-single" type="text" name="income_number" id="corporate_name">
                                        <option selected disabled>----- </option>
                                        @foreach($wares as $c)
                                            <option value="{{$c->income_number}}" {{$purchase->income_number == $c->income_number ? 'selected' : ''}}>{{$c->income_number}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('warehouse_name')) <small class="form-text text-danger">{{$errors->first('warehouse_name')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Debet</label>
                                    <select class="form-control js-example-basic-single" type="text" name="debet" id="debet">
                                        <option selected disabled>----- </option>
                                        @foreach($debet_credits as $c)
                                            <option value="{{$c->number}}" {{$purchase->debet == $c->number ? 'selected' : ''}}>{{$c->number}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('debet')) <small class="form-text text-danger">{{$errors->first('debet')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Kredit</label>
                                    <select class="form-control js-example-basic-single" type="text" name="credit" id="credit">
                                        <option selected disabled>----- </option>
                                        @foreach($debet_credits as $c)
                                            <option value="{{$c->number}}" {{$purchase->credit == $c->number ? 'selected' : ''}}>{{$c->number}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('credit')) <small class="form-text text-danger">{{$errors->first('credit')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Tarixi</label>
                                    <input value="{{$purchase->date}}" class="form-control" type="date" name="date">
                                    @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Elektron qaimə</label>
                                    <input value="{{$purchase->electron_invoice}}" class="form-control" type="text" name="electron_invoice">
                                    @if($errors->first('electron_invoice')) <small class="form-text text-danger">{{$errors->first('electron_invoice')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Məbləğ</label>
                                    <input value="{{$purchase->test_price}}" class="form-control" type="text" name="test_price">
                                    @if($errors->first('test_price')) <small class="form-text text-danger">{{$errors->first('test_price')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-12">

                                @livewire('purchase-products', ['purchase' => $purchase])

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
