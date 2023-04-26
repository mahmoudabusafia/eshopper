@extends('admin.layouts.layout')

@section('content')
    <div>
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0">
                <div class="card-title">
                    <h3 class="card-label">All Orders
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#orderAddModal">
                        <span class="svg-icon svg-icon-md">
                          <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" /><circle fill="#000000" cx="9" cy="15" r="6" />
                              <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                          </svg>
                            <!--end::Svg Icon-->
                        </span>Add Order
                    </button>

                    <!--end::Button-->
                </div>
            </div>
            <div class="container border-0 pt-6 pb-0" style="background-color: transparent; min-height: 70px">

                    <!--begin::Card-->
                    <div class="gutter-b example example-compact">
                        <div class="contentTable">
                            <button  type="button" class="btn btn-secondary btn--filter" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="icon-xl la la-sliders-h"></i>{{__('filter')}}</button>
                            <div class="collapse mt-5" id="collapseExample">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="form-group row mt-3">
                                            <label class="col-lg-1 col-form-label text-lg-left tex">Order No.</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" name="number" value="{{request('number')?request('number'):''}}"  placeholder="order number"/>
                                            </div>
                                            <label class="col-lg-1 col-form-label text-lg-left">Name</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" name="billing_name" value="{{request('billing_name')?request('billing_name'):''}}"  placeholder="name"/>
                                            </div>
                                            <label class="col-lg-1 col-form-label text-lg-left">Email</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" name="billing_email" value="{{request('billing_email')?request('billing_email'):''}}"  placeholder="email"/>
                                            </div>
                                        </div>

{{--                                        <div class="separator separator-dashed my-10"></div>--}}

                                        <div class="form-group row align-items-center">
                                            <label class="col-lg-1 col-form-label text-lg-left">Order Status</label>
                                            <div class="col-lg-3">
                                                <select id="multiple2" class="form-control"
                                                        name="status">
                                                    <option value="">{{__('all')}}</option>
                                                    <option value="pending" {{request('status') == 'pending'?'selected':''}}>
                                                        {{__('pending')}}
                                                    </option>
                                                    <option value="completed" {{request('status') == 'completed'?'selected':''}}>
                                                        {{__('completed')}}
                                                    </option>
                                                    <option value="cancelled" {{request('status') == 'cancelled'?'selected':''}}>
                                                        {{__('cancelled')}}
                                                    </option>
                                                </select>
                                            </div>
                                            <label class="col-lg-1 col-form-label text-lg-left">Payment Status</label>
                                            <div class="col-lg-3">
                                                <select id="multiple2" class="form-control"
                                                        name="payment_status">
                                                    <option value="">{{__('all')}}</option>
                                                    <option value="paid" {{request('payment_status') == 'paid'?'selected':''}}>
                                                        {{__('paid')}}
                                                    </option>
                                                    <option value="refund" {{request('payment_status') == 'refund'?'selected':''}}>
                                                        {{__('refund')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table-bordered" id="table_id">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Number</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Billing Name</th>
                        <th>Billing Email</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderAddModal" tabindex="-1" role="dialog" aria-labelledby="orderAddModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form class="form" action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row ">
                            <div class="col-lg-6">
                            <div class="form-group row ">
                                <label class="col-form-label col-lg-6">{{ __('Shipping value') }}</label>
                                <div class="col-lg-6">
                                    <input type="number"
                                           class="form-control form-control-solid @error('shipping-value')  is-invalid @enderror"
                                           name="shipping" value="{{ old('shipping') }}"
                                           placeholder="shipping value..."/>
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
                                               name="tax" value="{{ old('tax') }}"
                                               placeholder="tax value..."/>
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
                                               name="discount" value="{{ old('discount') }}"
                                               placeholder="discount value..."/>
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
                                               name="total" value="{{ old('total') }}"
                                               placeholder="total price..."/>
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
                                                <input type="radio" checked="checked" name="status" value="pending"/>
                                                <span></span>
                                                Pending
                                            </label>
                                            <label class="checkbox">
                                                <input type="radio" name="status" value="completed"/>
                                                <span></span>
                                                Completed
                                            </label>
                                            <label class="checkbox">
                                                <input type="radio" name="status" value="cancelled"/>
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
                                                <input type="radio" checked="checked" name="payment_status" value="paid"/>
                                                <span></span>
                                                Paid
                                            </label>
                                            <label class="checkbox">
                                                <input type="radio" name="payment_status" value="refund"/>
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
                                       name="billing_name" value="{{ old('billing_name') }}"
                                       placeholder="billing name..."/>
                                @error('billing_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text"
                                       class="form-control form-control-solid @error('shipping_name')  is-invalid @enderror"
                                       name="shipping_name" value="{{ old('shipping_name') }}"
                                       placeholder="shipping name..."/>
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
                                       name="billing_email" value="{{ old('billing_email') }}"
                                       placeholder="billing email..."/>
                                @error('billing_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text"
                                       class="form-control form-control-solid @error('shipping_email')  is-invalid @enderror"
                                       name="shipping_email" value="{{ old('shipping_email') }}"
                                       placeholder="shipping email..."/>
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
                                       name="billing_phone" value="{{ old('billing_phone') }}"
                                       placeholder="billing phone..."/>
                                @error('billing_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text"
                                       class="form-control form-control-solid @error('shipping_phone')  is-invalid @enderror"
                                       name="shipping_phone" value="{{ old('shipping_phone') }}"
                                       placeholder="shipping phone..."/>
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
                                       name="billing_address" value="{{ old('billing_phone') }}"
                                       placeholder="billing address..."/>
                                @error('billing_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text"
                                       class="form-control form-control-solid @error('shipping_address')  is-invalid @enderror"
                                       name="shipping_address" value="{{ old('shipping_address') }}"
                                       placeholder="shipping address..."/>
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
                                       name="billing_city" value="{{ old('billing_city') }}"
                                       placeholder="billing city..."/>
                                @error('billing_city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text"
                                       class="form-control form-control-solid @error('shipping_city')  is-invalid @enderror"
                                       name="shipping_city" value="{{ old('shipping_city') }}"
                                       placeholder="shipping city..."/>
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
                                       name="billing_country" value="{{ old('billing_country') }}"
                                       placeholder="billing country..."/>
                                @error('billing_country')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text"
                                       class="form-control form-control-solid @error('shipping_country')  is-invalid @enderror"
                                       name="shipping_country" value="{{ old('shipping_country') }}"
                                       placeholder="shipping country..."/>
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
                                                      placeholder="write a short notes..."></textarea>
                                @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="AddOrder">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Modal   --}}

@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            let table = $('#table_id').DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                // dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',
                // dom: 'Bfrtip',
                ordering: false,

                ajax: {
                    url:  "{{ route('orders.index') }}",
                    data: function (d) {
                        d.billing_name = $('input[name="billing_name"]').val()
                        d.billing_email = $('input[name="billing_email"]').val()
                        d.number = $('input[name="number"]').val()
                        d.status = $('select[name="status"]').val()
                        d.payment_status = $('select[name="payment_status"]').val()
                    }

                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'number',
                        name: 'number',
                    },
                    {
                        data: 'total',
                        name: 'total',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                    },
                    {
                        data: 'billing_name',
                        name: 'billing_name',
                    },
                    {
                        data: 'billing_email',
                        name: 'billing_email',
                    },
                    {
                        data: 'notes',
                        name: 'notes',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                    },
                ],
            });


            $('input').on('keyup', function(e) {
                table.draw();
                e.preventDefault();
            });
            $('select').on('change', function(e) {
                table.draw();
                e.preventDefault();
            });


            setTimeout(function (){
                let switchElement = document.querySelectorAll(".status-switch");

                switchElement.forEach((el) => {
                    el.addEventListener('change', function() {
                        let orderStatus = el.value;
                        let orderId = el.dataset.id;
                        sendStatus(orderId,orderStatus);
                    });
                });

                function sendStatus(orderId,orderStatus) {
                    let formData = new FormData();
                    formData.append('orderId', orderId);
                    formData.append('orderStatus', orderStatus);
                    fetch('{{ route('orders.status-update') }}', {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            if (response.ok) {
                                toastr.success('done!', 'Status updated!', 'success');

                            } else {
                                toastr.error('error!', 'Status error1', 'error');
                            }
                        })
                        .catch(error => {
                            toastr.error('error!', 'Status error1', 'error');
                        });
                }

            },1000);

        });
        // $('select[name="status"]').
    </script>
@endpush
