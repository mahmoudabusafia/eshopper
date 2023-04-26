@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-label"> Show Order #{{$order->number}}
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" /><circle fill="#000000" cx="9" cy="15" r="6" />
                              <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                          </svg>
                            <!--end::Svg Icon-->
                        </span>Edit Order
                                    </a>

                                    <!--end::Button-->
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
{{--                            <form class="form" action="{{ route('orders.index') }}" method="get" enctype="multipart/form-data">--}}
                                <div class="card-body">
                                    <div class="form-group row ">
                                        <div class="col-lg-6">
                                            <div class="form-group row ">
                                                <label class="col-form-label col-lg-6">{{ __('Shipping value') }}</label>
                                                <div class="col-lg-6">
                                                    <input type="number"
                                                           class="form-control form-control-solid @error('shipping-value')  is-invalid @enderror"
                                                           name="shipping" value="{{ old('shipping', $order->shipping) }}"
                                                           placeholder="shipping value..." disabled />
                                                    @error('shipping-value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row ">
                                                <label class="col-form-label col-lg-4">{{ __('Tax value') }}</label>
                                                <div class="col-lg-6">
                                                    <input type="number"
                                                           class="form-control form-control-solid @error('tax-value')  is-invalid @enderror"
                                                           name="tax" value="{{ old('tax', $order->tax) }}"
                                                           placeholder="tax value..." disabled/>
                                                    @error('tax-value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-lg-6">
                                            <div class="form-group row ">
                                                <label class="col-form-label col-lg-6">{{ __('Discount value') }}</label>
                                                <div class="col-lg-6">
                                                    <input type="number"
                                                           class="form-control form-control-solid @error('discount-value')  is-invalid @enderror"
                                                           name="discount" value="{{ old('discount', $order->discount) }}"
                                                           placeholder="discount value..." disabled/>
                                                    @error('discount-value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row ">
                                                <label class="col-form-label col-lg-4">{{ __('Total price') }}</label>
                                                <div class="col-lg-6">
                                                    <input type="number"
                                                           class="form-control form-control-solid @error('total-price')  is-invalid @enderror"
                                                           name="total" value="{{ old('total', $order->total) }}"
                                                           placeholder="total price..." disabled/>
                                                    @error('total-price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-lg-6">
                                            <div class="form-group row ">
                                                <label class="col-6 col-form-label">Order Status</label>
                                                <div class="col-6 col-form-label">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox">
                                                            <input type="radio" @if($order->status == 'pending') checked="checked" @endif  name="status" value="pending" disabled/>
                                                            <span></span>
                                                            Pending
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="radio" @if($order->status == 'completed') checked="checked" @endif name="status" value="completed" disabled/>
                                                            <span></span>
                                                            Completed
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="radio" @if($order->status == 'cancelled') checked="checked" @endif name="status" value="cancelled" disabled/>
                                                            <span></span>
                                                            Cancelled
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row ">
                                                <label class="col-4 col-form-label">Payment Status</label>
                                                <div class="col-6 col-form-label">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox">
                                                            <input type="radio" @if($order->payment_status == 'paid') checked="checked" @endif name="payment_status" value="paid" disabled/>
                                                            <span></span>
                                                            Paid
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="radio" @if($order->payment_status == 'refund') checked="checked" @endif name="payment_status" value="refund" disabled/>
                                                            <span></span>
                                                            Refund
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Name (billing,shipping)') }}</label>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('billing_name')  is-invalid @enderror"
                                                   name="billing_name" value="{{ old('billing_name', $order->billing_name) }}"
                                                   placeholder="billing name..." disabled/>
                                            @error('billing_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('shipping_name')  is-invalid @enderror"
                                                   name="shipping_name" value="{{ old('shipping_name', $order->shipping_name) }}"
                                                   placeholder="shipping name..." disabled/>
                                            @error('shipping_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Email (billing,shipping)') }}</label>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('billing_email')  is-invalid @enderror"
                                                   name="billing_email" value="{{ old('billing_email', $order->billing_email) }}"
                                                   placeholder="billing email..." disabled/>
                                            @error('billing_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('shipping_email')  is-invalid @enderror"
                                                   name="shipping_email" value="{{ old('shipping_email', $order->shipping_email) }}"
                                                   placeholder="shipping email..." disabled/>
                                            @error('shipping_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Phone (billing,shipping)') }}</label>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('billing_phone')  is-invalid @enderror"
                                                   name="billing_phone" value="{{ old('billing_phone', $order->billing_phone) }}"
                                                   placeholder="billing phone..." disabled/>
                                            @error('billing_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('shipping_phone')  is-invalid @enderror"
                                                   name="shipping_phone" value="{{ old('shipping_phone', $order->shipping_phone) }}"
                                                   placeholder="shipping phone..." disabled/>
                                            @error('shipping_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Address (billing,shipping)') }}</label>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('billing_address')  is-invalid @enderror"
                                                   name="billing_address" value="{{ old('billing_address', $order->billing_address) }}"
                                                   placeholder="billing address..." disabled/>
                                            @error('billing_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('shipping_address')  is-invalid @enderror"
                                                   name="shipping_address" value="{{ old('shipping_address', $order->shipping_address) }}"
                                                   placeholder="shipping address..." disabled/>
                                            @error('shipping_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('City (billing,shipping)') }}</label>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('billing_city')  is-invalid @enderror"
                                                   name="billing_city" value="{{ old('billing_city', $order->billing_city) }}"
                                                   placeholder="billing city..." disabled/>
                                            @error('billing_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('shipping_city')  is-invalid @enderror"
                                                   name="shipping_city" value="{{ old('shipping_city', $order->shipping_city) }}"
                                                   placeholder="shipping city..." disabled/>
                                            @error('shipping_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Country (billing,shipping)') }}</label>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('billing_country')  is-invalid @enderror"
                                                   name="billing_country" value="{{ old('billing_country', $order->billing_country) }}"
                                                   placeholder="billing country..." disabled/>
                                            @error('billing_country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('shipping_country')  is-invalid @enderror"
                                                   name="shipping_country" value="{{ old('shipping_country', $order->shipping_country) }}"
                                                   placeholder="shipping country..." disabled/>
                                            @error('shipping_country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Notes') }}</label>
                                        <div class="col-lg-8">
                                            <textarea type="text"
                                                      class="form-control form-control-solid @error('notes')  is-invalid @enderror"
                                                      name="notes" value="{{ old('notes') }}"
                                                      placeholder="write a short notes..." disabled>{{$order->notes}}</textarea>
                                            @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Products') }}</label>
                                        <div class="col-lg-8">
                                        <table class="table table-striped table-head-bg table-active table-primary" >
                                            <thead>
                                            <tr>
                                                <th>P-ID</th>
                                                <th>Product Name</th>
                                                <th>QTY</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->items as $item)
                                                <tr>
                                                    <td>{{ $item->product->id }}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->product->price }}</td>
                                                    <td>{{ $item->quantity * $item->product->price }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <a href="{{ route('orders.index') }}" class="btn btn-primary font-weight-bold mr-2">GO Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
{{--                            </form>--}}
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection



