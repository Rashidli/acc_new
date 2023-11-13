@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Layihə əlavə et</h4>
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
                                        <label class="col-form-label">Başlama tarixi</label>
                                        <input value="{{old('start_date')}}" class="form-control" type="date" name="start_date">
                                        @if($errors->first('start_date')) <small class="form-text text-danger">{{$errors->first('start_date')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Bitmə tarixi</label>
                                        <input value="{{old('end_date')}}" class="form-control" type="date" name="end_date">
                                        @if($errors->first('end_date')) <small class="form-text text-danger">{{$errors->first('end_date')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Qiyməti</label>
                                        <input value="{{old('amount')}}" class="form-control" type="text" name="amount">
                                        @if($errors->first('amount')) <small class="form-text text-danger">{{$errors->first('amount')}}</small> @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="col-form-label">Müəssisə adı</label>
                                        <select class="form-control js-example-basic-single" type="text" name="company" id="corporate_name">
                                            <option selected disabled>----- </option>
                                            @foreach($ins as $c)
                                                <option value="{{$c->title}}" {{old('company') == $c->title ? 'selected' : ''}}>{{$c->title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->first('company')) <small class="form-text text-danger">{{$errors->first('company')}}</small> @endif
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
