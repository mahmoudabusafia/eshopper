@extends('web.layouts')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">My Orders</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">My Orders</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Full Name: {{ $order->shipping_name }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>E-mail: {{ $order->shipping_email }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Mobile No: {{ $order->shipping_phone }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Address: {{ $order->shipping_address }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Country: {{ $order->shipping_country }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>City: {{ $order->shipping_city }}</label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Order Details</h4>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Order No: {{ $order->number }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Shipping: {{ $order->shipping }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Discount: {{ $order->discount }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Tax: {{ $order->tax }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Sub Total: {{ $order->total }}</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Total: {{ $order->total + $order->tax + $order->shipping - $order->discount }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                        <h5 class="font-weight-medium mb-3">Product</h5>
                            <div style="display:flex; justify-content: space-between">
                                <h5 class="font-weight-medium mb-3 mr-5">Qty</h5>
                                <h5 class="font-weight-medium mb-3 ml-5">Price</h5>
                                <h5 class="font-weight-medium mb-3 ml-5">total</h5>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between">
                            <p class="font-weight-medium mb-3">{{ $item->product->name }}</p>
                            <div style="display:flex;">
                                <p class="font-weight-medium mb-3" style="margin-right: 90px">{{ $item->quantity }}</p>
                                <p class="font-weight-medium mb-3 ml-5">${{ $item->price }}</p>
                                <p class="font-weight-medium mb-3 ml-5">{{ $item->price * $item->quantity }}</p>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="font-weight-medium mb-3">Total</p>
                            <div style="display:flex;">
                                <p class="font-weight-medium mb-3 ">${{ $order->total }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout End -->
@endsection
