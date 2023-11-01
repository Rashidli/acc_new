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
                                <h4 class="card-title">Paketlər</h4>

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
                                                <th>Bank kodu</th>
                                                <th>Bank hesab nömrəsi</th>
                                                <th>VÖEN</th>
                                                <th>Adı</th>
                                                <th>Məbləğ</th>
                                                <th>Təyinat</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($packages as $ins)
                                                <tr>

                                                    <td><input type="radio" class="radio_input" name="check" data-delete="{{route('packages.destroy', $ins->id)}}"></td>
                                                    <td>{{$ins->bank_code}}</td>
                                                    <td>{{$ins->bank_account_number}}</td>
                                                    <td>{{$ins->voen}}</td>
                                                    <td>{{$ins->title}}</td>
                                                    <td>{{$ins->amount}}</td>
                                                    <td>{{$ins->elect_invoice}}</td>

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
