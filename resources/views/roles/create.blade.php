@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Role əlavə et</h4>
                                <form action="{{route('roles.store')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="example-email-input" class="col-form-label">Name</label>
                                        <input class="form-control" type="text" name="name" id="example-email-input">
                                        @if($errors->first('name')) <small class="form-text text-danger">{{$errors->first('name')}}</small> @endif
                                    </div>
                                    @foreach($permissions as $key => $permission)
                                        @if($key % 4 == 0)
                                            <br>
                                            <input class="group-checkbox" id="{{$permission->group_name}}" data-group="{{$permission->group_name}}" type="checkbox">
                                            <label style="font-weight: 600" for="{{$permission->group_name}}">{{$permission->group_name}}</label> <br><br>
                                        @endif

                                        <input id="{{$permission->id}}" type="checkbox" name="permission[]" data-group="{{$permission->group_name}}" value="{{$permission->name}}">
                                        <label for="{{$permission->id}}">{{$permission->name}}</label><br>

                                    @endforeach
                                    <div class="mb-3">
                                        <button class="btn btn-primary">Submit</button>
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
