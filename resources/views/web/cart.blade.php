@extends('web.layouts')


@section('content')



<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                <tr>
                    <th>Image</th>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                @if($cart->count() == 0)
                    <tr>
                        <td class="align-middle" colspan="6">Empty</td>
                    </tr>
                @else
                @foreach($cart as $item)
                <tr>
                    <td class="align-middle"><img src="{{ $item->product->image_url }}" alt="" style="width: 50px;"></td>
                    <td>{{ $item->product->name }}</td>
                    <td class="align-middle">${{ $item->product->price }}</td>
                    <td class="align-middle">
                        <div class="input-group mx-auto qty" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary decrement-btn">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm bg-secondary text-center qty-input" value="{{ $item->quantity }}">
                            <input type="hidden" class="item-id" value="{{ $item->id }}">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary increment-btn">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">${{ $item->quantity * $item->product->price }}</td>
                    <td class="align-middle">
                    <form action="{{ route('cart.delete', $item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button  type="submit" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                    </form>
                </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">${{$total}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">${{$total + 10}}</h5>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function (){
            $('.increment-btn').click(function (e){
                e.preventDefault();
                let id = $(this).parents('.qty').find('.item-id').val();

                let inc_value = $(this).parents('.qty').find('.qty-input').val();
                let value = parseInt(inc_value, 10);
                value = isNaN(value) ? 1 : value;
                if(value < 10)
                {
                    value++;
                    $(this).parents('.qty').find('.qty-input').val(value);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('change.qty') }}',
                        dataType : 'json',
                        type: 'POST',
                        data: {
                            id: id,
                            qty: value,
                        },
                        success:function(response) {
                            console.log(response);
                        }
                    });
                    location.reload();
                }
            });

            $('.decrement-btn').click(function (e){
                e.preventDefault();

                let id = $(this).parents('.qty').find('.item-id').val();
                let dec_value = $(this).parents('.qty').find('.qty-input').val();
                let value = parseInt(dec_value, 10);
                value = isNaN(value) ? 1 : value;
                if(value > 1)
                {
                    value--;
                    $(this).parents('.qty').find('.qty-input').val(value);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('change.qty') }}',
                        dataType : 'json',
                        type: 'POST',
                        data: {
                            id: id,
                            qty: value,
                        },
                        success:function(response) {
                            console.log(response);
                        }
                    });
                    location.reload();
                }

            });
        });
    </script>
@endpush

