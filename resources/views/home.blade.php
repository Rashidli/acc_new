@include('includes.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin panel</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

{{--            <div class="row">--}}
{{--                <div class="col-xl-3 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <div class="flex-grow-1">--}}
{{--                                    <p class="text-truncate font-size-14 mb-2">Müştəri sayı</p>--}}
{{--                                    <h4 class="mb-2">{{$customer_count}}</h4>--}}
{{--                                </div>--}}

{{--                                <div class="avatar-sm">--}}
{{--                                                <span class="avatar-title bg-light text-primary rounded-3">--}}
{{--                                                    <i class="ri-user-3-line font-size-24"></i>--}}
{{--                                                </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- end cardbody -->--}}
{{--                    </div><!-- end card -->--}}
{{--                </div><!-- end col -->--}}
{{--                <div class="col-xl-3 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <div class="flex-grow-1">--}}
{{--                                    <p class="text-truncate font-size-14 mb-2">Görüş sayı</p>--}}
{{--                                    <h4 class="mb-2">{{$meeting_count}}</h4>--}}

{{--                                </div>--}}
{{--                                <div class="avatar-sm">--}}
{{--                                                <span class="avatar-title bg-light text-success rounded-3">--}}
{{--                                                    <i class="mdi mdi-currency-usd font-size-24"></i>--}}
{{--                                                </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- end cardbody -->--}}
{{--                    </div><!-- end card -->--}}
{{--                </div><!-- end col -->--}}
{{--                <div class="col-xl-3 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <div class="flex-grow-1">--}}
{{--                                    <p class="text-truncate font-size-14 mb-2">Əsas ödənişlər</p>--}}
{{--                                    <h4 class="mb-2">{{$payment_count}}</h4>--}}
{{--                                </div>--}}
{{--                                <div class="avatar-sm">--}}
{{--                                                <span class="avatar-title bg-light text-primary rounded-3">--}}
{{--                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>--}}
{{--                                                </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- end cardbody -->--}}
{{--                    </div><!-- end card -->--}}
{{--                </div><!-- end col -->--}}
{{--                <div class="col-xl-3 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <div class="flex-grow-1">--}}
{{--                                    <p class="text-truncate font-size-14 mb-2">Akt sayı</p>--}}
{{--                                    <h4 class="mb-2">{{$act_count}}</h4>--}}
{{--                                </div>--}}
{{--                                <div class="avatar-sm">--}}
{{--                                                <span class="avatar-title bg-light text-success rounded-3">--}}
{{--                                                    <i class="mdi mdi-currency-btc font-size-24"></i>--}}
{{--                                                </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- end cardbody -->--}}
{{--                    </div><!-- end card -->--}}
{{--                </div><!-- end col -->--}}
{{--            </div>--}}
            <!-- end row -->


        </div>

    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Corporate
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted by Seymur Rashidli
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

@include('includes.footer')
