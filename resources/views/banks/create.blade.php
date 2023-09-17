@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('banks.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bank əlavə et</h4>
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
                                        <label class="col-form-label">Hesab</label>
                                        <input value="{{old('account')}}" class="form-control" type="text" name="account">
                                        @if($errors->first('account')) <small class="form-text text-danger">{{$errors->first('account')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Swift</label>
                                        <input value="{{old('swift')}}" class="form-control" type="text" name="swift">
                                        @if($errors->first('swift')) <small class="form-text text-danger">{{$errors->first('swift')}}</small> @endif
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
