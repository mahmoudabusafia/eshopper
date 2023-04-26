@extends('web.layouts')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('shop') }}">Shop</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">{{ $category->name }}</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

{{--    <form action="{{ route('shop') }}" method="get">--}}
    <!-- Shop Start -->
    <div class="container-fluid pt-5 do-filter">
        <div class="row px-xl-5 justify-content-center">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
{{--                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3" style="margin-left: 215px;">--}}
{{--                        <button class="btn border bg-primary opacity-5"><span style="color: black"><i class="fa fa-search"></i> Filter</span></button>--}}
{{--                    </div>--}}
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <select id= "price" class="form-control selectpicker">
                                <option value="*">All Price</option>
                                <option value="1">$0 - $100</option>
                                <option value="2">$100 - $200</option>
                                <option value="3">$200 - $300</option>
                                <option value="4">$300 - $400</option>
                                <option value="5">$400 - $500</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <select id= "color" class="form-control selectpicker">
                                <option value="*">All Color</option>
                                <option value="black">Black</option>
                                <option value="white">White</option>
                                <option value="red">Red</option>
                                <option value="blue">Blue</option>
                                <option value="green">Green</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Color End -->

                <!-- Size Start -->

                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <select id= "size" class="form-control selectpicker toggle-on" >
                                <option value="*">All Size</option>
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="x">X</option>
                                <option value="xl">XL</option>
                                <option value="xxl">XXL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="input-group">
                                    <input type="text" id="search-input" class="form-control" name="search" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row pb-3 list" style="width: 100%;" id="list">
                        @if($products->count() == 0)
                            <div style="margin-left: 300px;margin-top: 150px">
                                <h6>Empty. you may show another product <a href="{{ route('shop') }}">see.</a></h6>
                            </div>
                        @else
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product-card" >
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{ $product->image_url }}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3 product-name">{{$product->name}}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6 class="price">$<span>{{$product->price}}</span></h6><h6 class="text-muted ml-2"><del>${{$product->price}}</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{ route('product.details', $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <form action="{{ route('cart') }}" method="post" id="add-to-cart">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-12 pb-1">
                        <nav class="pagination-container" aria-label="Page navigation" >
                                <div class="pagination justify-content-center mb-3 pagenumbers" id="pagination">
                                    {{ $products->links() }}
                                </div>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
{{--    </form>--}}

    @push('style')
        <style>
        .hidePrice{
            display: none;
        }
        .hideSearch{
            display: none;
        }
        </style>
    @endpush

    @push('scripts')
    <script>
        $(document).ready(function() {

            let price= document.querySelector('#price');
{{--        let color= document.querySelector('#color');--}}
{{--        let size= document.querySelector('#size');--}}


        price.addEventListener('change', function (){
            filterProduct(price.value)
        })

        // color.addEventListener('change', function (){
        //     colorOutput= color.value;
        //     console.log(colorOutput);
        // })
        //
        // size.addEventListener('change', function (){
        //     sizerOutput= size.value;
        //     console.log(sizerOutput);
        // })

        let search = document.getElementById("search-input");
        search.addEventListener("keyup", () => {
            //initializations
            let searchInput = search.value.toUpperCase();
            let cardDiv = document.getElementById("list");
            let elements = cardDiv.querySelectorAll(".product-card");

            //loop through all cards
            elements.forEach((element) => {
                let item = element.querySelector(".product-name").innerHTML.toUpperCase();

                if (item.includes(searchInput)) {
                    //display matching card
                    element.classList.remove("hideSearch");
                } else {
                    //hide others
                    element.classList.add("hideSearch");
                }
            });
        });

{{--            // parameter passed from select price   (Parameter same as price)--}}
            function filterProduct(selectVal) {
                //select all cards
                let cardDiv = document.getElementById("list");
                let elements = cardDiv.querySelectorAll(".product-card");

                //loop through all cards
                elements.forEach((element) => {
                    let item = element.querySelector(".price span");
                    let price = parseInt(item.innerHTML);
                    let max = selectVal * 100;
                    let min = (selectVal - 1) * 100;

                        if (selectVal == "*") {
                            //display element based on category
                            element.classList.remove("hidePrice");
                        }else {
                            //Check if element contains category class
                            if (price >= min && price < max) {
                                //display element based on category
                                element.classList.remove("hidePrice");
                            } else {
                                //hide other elements
                                element.classList.add("hidePrice");
                            }
                        }
                });
            }

        });
    </script>
    @endpush
@endsection
