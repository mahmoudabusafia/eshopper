<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/web/img/favicon.ico') }}" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/web/css/style.css') }}" rel="stylesheet">

    <!--begin::Toastr js-->
    {{--        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet" />--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!--end::Toastr js-->

    @stack('style')
</head>

<body>
<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="display: flex; align-items: center; justify-content: center">
        <div class="col-lg-4 d-none d-lg-block" style="cursor: default;">
            <a class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                        <a class="text-decoration-none d-block d-lg-none">
                            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                                <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="{{ route('cart') }}" class="dropdown-item">Shopping Cart</a>
                                        <a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a>
                                    </div>
                                </div>
                                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 display-flex">
            @if(Auth::user())

                <div class="dropdown w-100">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}
                    </button>
                    <div class="dropdown-menu" style="width: 67%">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        <a class="dropdown-item" href="#">Setting</a>
                        <hr>
                        <a class="dropdown-item">
                            <form action="{{ route('logout') }}" method="post" >
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-sm text-dark p-0">Logout</button>
                            </form>
                        </a>
                    </div>
                </div>

            @else
                <a href="{{ route('login') }}" class="btn border bg-primary opacity-5"><span style="color: black">Login</span></a>
                <a href="{{ route('register') }}" class="btn border bg-primary opacity-5"><span style="color: black">Register</span></a>
            @endif
        </div>
    </div>
</div>
<!-- Topbar End -->

{{--<!-- Navbar Start -->--}}
{{--<div class="container-fluid mb-5">--}}
{{--    <div class="row border-top px-xl-5">--}}
{{--        <div class="col-lg-3 d-none d-lg-block">--}}
{{--            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100 collapsed" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">--}}
{{--                <h6 class="m-0">Categories</h6>--}}
{{--                <i class="fa fa-angle-down text-dark"></i>--}}
{{--            </a>--}}
{{--            <nav class="collapse @yield('show') position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">--}}
{{--                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        @if($category->name === 'Dresses')--}}
{{--                            <div class="nav-item dropdown">--}}
{{--                                <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }} <i class="fa fa-angle-down float-right mt-1"></i></a>--}}
{{--                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">--}}
{{--                                    @foreach($category->children as $sub)--}}
{{--                                        <a href="#" class="dropdown-item">{{$sub->name}}</a>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <a href="#" class="nav-item nav-link">{{ $category->name }}</a>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--        <div class="col-lg-9">--}}
{{--            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">--}}
{{--                <a class="text-decoration-none d-block d-lg-none">--}}
{{--                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>--}}
{{--                </a>--}}
{{--                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}
{{--                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">--}}
{{--                    <div class="navbar-nav mr-auto py-0">--}}
{{--                        <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>--}}
{{--                        <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>--}}
{{--                        <div class="nav-item dropdown">--}}
{{--                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>--}}
{{--                            <div class="dropdown-menu rounded-0 m-0">--}}
{{--                                <a href="{{ route('cart') }}" class="dropdown-item">Shopping Cart</a>--}}
{{--                                <a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>--}}
{{--                    </div>--}}
{{--                    <div class="navbar-nav ml-auto py-0">--}}
{{--                        <a href="#" class="btn border">--}}
{{--                            <i class="fas fa-heart text-primary"></i>--}}
{{--                            <span class="badge">0</span>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('cart') }}" class="btn border">--}}
{{--                            <i class="fas fa-shopping-cart text-primary"></i>--}}
{{--                            <span class="badge">{{ $cart->count()}}</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--            @yield('slider')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- Navbar End -->--}}


{{-- content --}}
<div class="container-fluid pt-5">
    <div class="text-center mb-4 ml-5">
        <h2 class="section-title px-5"><span class="px-2">User Profile</span></h2>
    </div>
    <div class="row px-xl-5" style="justify-content: center">
        <div class="col-lg-7 mb-5">
            <div class="form-group">
                <div id="success"></div>
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control form-input @error('name')  is-invalid @enderror " id="name" name="name" type="text"  value="{{ old('name', $user->name) }}" />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control form-input @error('email')  is-invalid @enderror " id="email" name="email" type="email"  value="{{ old('email', $user->email) }}" />
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Save</button>
                    </div>
                </form>
            </div>
            <div class="form-group">
                <div id="success"></div>
            </div>
        </div>
    </div>
</div>
{{-- content end--}}


<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark">
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-12 px-xl-0">
            <p class="mb-md-0 text-center text-md-center text-dark">
                <a class="text-dark font-weight-semi-bold" href="#"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</a>. All Rights Reserved.  &copy;2023
            </p>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/web/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/web/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets/web/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/cart.js') }}"></script>

<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "background-color": "#4CAF50",

        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
@stack('scripts')
</body>

</html>
