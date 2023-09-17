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
                                <h4 class="card-title">Layihələr</h4>

                                        <a href="{{route('projects.create')}}" class="btn btn-primary">+</a>
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
                                            <th>Başlama tarixi</th>
                                            <th>Bitmə tarixi</th>
                                            <th>Qiyməti</th>
                                            <th>Müəssisə adı</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td><input type="radio" class="radio_input" name="check" data-edit="{{route('projects.edit',$project->id)}}" data-delete="{{route('projects.destroy', $project->id)}}"></td>
                                                <td>{{$project->title}}</td>
                                                <td>{{$project->start_date}}</td>
                                                <td>{{$project->end_date}}</td>
                                                <td>{{$project->price}}</td>
                                                <td>{{$project->company}}</td>

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
