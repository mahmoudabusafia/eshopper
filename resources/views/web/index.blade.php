@extends('web.layouts')

@section('show')
    show
@endsection
@section('slider')
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="{{ asset('assets/web/img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                        <a href="{{ route('shop') }}" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="{{ asset('assets/web/img/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                        <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
@endsection

@section('content')

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trendy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ $product->image_url }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${{$product->price}}</h6><h6 class="text-muted ml-2"><del>${{$product->price}}</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('product.details', $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <form action="{{ route('cart') }}" method="post">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                @csrf
                                <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row px-xl-5 pb-3 justify-content-end">
            <a href="{{ route('shop') }}" class="bg-secondary" style="font-size: 30px;">See All Products <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- Products End -->


    <!-- Subscribe Start -->
    @if(!Auth::user())
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <!-- Subscribe End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ $product->image_url }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>${{$product->price}}</h6><h6 class="text-muted ml-2"><del>${{$product->price}}</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('product.details', $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <form action="{{ route('cart') }}" method="post" id="add-to-cart">
                            @csrf
                            @method('post')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row px-xl-5 pb-3 justify-content-end">
            <a href="{{ route('shop') }}" class="bg-secondary" style="font-size: 30px;">See All Products <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
{{--    <div class="container-fluid py-5">--}}
{{--        <div class="row px-xl-5">--}}
{{--            <div class="col">--}}
{{--                <div class="owl-carousel vendor-carousel">--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-1.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-2.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-3.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-4.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-5.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-6.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-7.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="vendor-item border p-4">--}}
{{--                        <img src="{{ asset('assets/web/img/vendor-8.jpg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Vendor End -->

@endsection
