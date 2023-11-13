@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('plans.update', $plan->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$plan->number}}</h4>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Nömrə</label>
                                    <input value="{{$plan->number}}" class="form-control" type="text" name="number">
                                    @if($errors->first('number')) <small class="form-text text-danger">{{$errors->first('number')}}</small> @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Adı</label>
                                    <input value="{{$plan->title}}" class="form-control" type="text" name="title">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
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
