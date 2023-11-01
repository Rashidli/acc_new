@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('reports.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Əlavə et</h4>
                            <div class="row">

                                <div class="col-3">
                                    <div class="mb-3">

                                        <label  class="col-form-label">Elektron qaimə</label>
                                        <select class="form-control js-example-basic-single" type="text" name="electron_invoice" id="electron_invoice">
                                            <option selected disabled> ----- </option>
                                            @foreach($purchases as $c)
                                                <option value="{{$c->electron_invoice}}" {{old('electron_invoice') == $c->electron_invoice ? 'selected' : ''}}>{{$c->electron_invoice}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->first('electron_invoice')) <small class="form-text text-danger">{{$errors->first('electron_invoice')}}</small> @endif

                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Müəssisə</label>
                                        <input value="{{old('company')}}" class="form-control" type="text" name="company">
                                        @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Cəm</label>
                                        <input value="{{old('total_amount')}}" class="form-control" type="text" name="total_amount">
                                        @if($errors->first('total_amount')) <small class="form-text text-danger">{{$errors->first('total_amount')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Tarixi</label>
                                        <input value="{{old('date')}}" class="form-control" type="date" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">ƏDV xaric məbələğ</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">ƏDV məbləği</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Ödəniş Əsas</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Ödəniş ƏDV</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Qalıq Əsas</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Qalıq ƏDV</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Qalıq Cəm</label>
                                        <input value="{{old('date')}}" class="form-control" type="text" name="date">
                                        @if($errors->first('date')) <small class="form-text text-danger">{{$errors->first('date')}}</small> @endif
                                    </div>
                                </div>

{{--                                Orda başlıqlar var e onlar deməli indi yazdığım ardıcıllıqla olacaq - Eqaimə - Müəssisə - Tarix  - Cəm - ƏDV xaric məbələğ - ƏDV məbləği - Ödəniş Əsas - Ödəniş ƏDV -  Qalıq Əsas - Qalıq ƏDV -  Qalıq Cəm--}}

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
