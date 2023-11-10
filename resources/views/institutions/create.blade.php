@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('institutions.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Müəssisə əlavə et</h4>
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Adı</label>
                                        <input value="{{old('title')}}" class="form-control" type="text" name="title">
                                        @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">VÖEN</label>
                                        <input value="{{old('voen')}}" class="form-control" type="number" name="voen">
                                        @if($errors->first('voen')) <small class="form-text text-danger">{{$errors->first('voen')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Bank hesab nömrəsi</label>
                                        <input value="{{old('bank_account_number')}}" class="form-control" type="text" name="bank_account_number">
                                        @if($errors->first('bank_account_number')) <small class="form-text text-danger">{{$errors->first('bank_account_number')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Bank kodu</label>
                                        <input value="{{old('bank_code')}}" class="form-control" type="text" name="bank_code">
                                        @if($errors->first('bank_code')) <small class="form-text text-danger">{{$errors->first('bank_code')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Bank VÖEN</label>
                                        <input value="{{old('bank_voen')}}" class="form-control" type="text" name="bank_voen">
                                        @if($errors->first('bank_voen')) <small class="form-text text-danger">{{$errors->first('bank_voen')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Swift</label>
                                        <input value="{{old('swift')}}" class="form-control" type="text" name="swift">
                                        @if($errors->first('swift')) <small class="form-text text-danger">{{$errors->first('swift')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Müxbir hesab</label>
                                        <input value="{{old('correspondent_account')}}" class="form-control" type="text" name="correspondent_account">
                                        @if($errors->first('correspondent_account')) <small class="form-text text-danger">{{$errors->first('correspondent_account')}}</small> @endif
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Müqavilə</label>
                                        <input value="{{old('contract')}}" class="form-control" type="text" name="contract">
                                        @if($errors->first('contract')) <small class="form-text text-danger">{{$errors->first('contract')}}</small> @endif
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
