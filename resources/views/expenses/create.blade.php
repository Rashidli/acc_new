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
                                        <label class="col-form-label">Müəssisə adı</label>
                                        <select class="form-control js-example-basic-single" type="text" name="company" id="company">
                                            <option selected disabled>----- </option>
                                            @foreach($ins as $c)
                                                <option value="{{$c->title}}" {{old('company') == $c->title ? 'selected' : ''}}>{{$c->title}}</option>
                                            @endforeach
                                        </select>
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

                                    @livewire('products')

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
