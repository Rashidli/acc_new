@include('includes.header')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(session('message'))
                                    <div class="alert alert-success">{{session('message')}}</div>
                                @endif
                                <h4 class="card-title">Banklar</h4>
                                        <a href="{{route('banks.create')}}" class="btn btn-primary">+</a>
                                    <a href="" class="btn btn-primary" style="margin-right: 15px" >Edit</a>
                                    <form action="" method="post" style="display: inline-block">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" disabled class="btn btn-danger">Delete</button>
                                    </form>
                                <br>
                                <br>

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Seç</th>
                                            <th>Adı</th>
                                            <th>Hesab</th>
                                            <th>Swift</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($banks as $bank)
                                            <tr>
                                                <td><input type="radio" class="radio_input" name="check" data-edit="{{route('banks.edit',$bank->id)}}" data-delete="{{route('banks.destroy', $bank->id)}}"></td>
                                                <td>{{$bank->title}}</td>
                                                <td>{{$bank->account}}</td>
                                                <td>{{$bank->swift}}</td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
