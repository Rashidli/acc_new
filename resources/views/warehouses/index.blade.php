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
                                <h4 class="card-title">Anbarlar</h4>
                                    <a href="{{route('warehouses.create')}}" class="btn btn-primary ">+</a>
                                    <a href="" class="btn btn-primary edit_form" style="margin-right: 15px" >Edit</a>
                                    <form action="" method="post" style="display: inline-block" class="delete_form">
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
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($warehouses as $warehouse)
                                            <tr>
                                                <td><input type="radio" class="radio_input" name="check" data-edit="{{route('warehouses.edit',$warehouse->id)}}" data-delete="{{route('warehouses.destroy', $warehouse->id)}}"></td>
                                                <td>{{$warehouse->title}}</td>
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
