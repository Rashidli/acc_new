@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$product->title}}</h4>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Adı</label>
                                    <input value="{{$product->title}}" class="form-control" type="text" name="title">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Vahidi</label>
                                    <input value="{{$product->unit}}" class="form-control" type="text" name="unit">
                                    @if($errors->first('unit')) <small class="form-text text-danger">{{$errors->first('unit')}}</small> @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Kodu</label>
                                    <input value="{{$product->code}}" class="form-control" type="number" name="code">
                                    @if($errors->first('code')) <small class="form-text text-danger">{{$errors->first('code')}}</small> @endif
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
