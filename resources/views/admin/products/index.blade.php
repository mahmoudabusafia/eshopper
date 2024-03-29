@extends('admin.layouts.layout')

@section('content')
<div >
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">All Products
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#productAddModal">
        <span class="svg-icon svg-icon-md">
          <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24" />
              <circle fill="#000000" cx="9" cy="15" r="6" />
              <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
            </g>          </svg>
            <!--end::Svg Icon-->
        </span>Add Product
                </button>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-responsive table-head-custom table-checkable" id="table_id">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Owner</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
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
<div class="modal fade" id="productAddModal" tabindex="-1" role="dialog" aria-labelledby="productAddModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ __('Image') }}</label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper"
                                     style="background-image: url({{asset('assets/admin/assets/media/users/blank.png')}});
                                                            width: 120px;
                                                            height: 120px;"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Add Image">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>

                                <span
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Remove Image">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Product Name') }}</label>
                        <div class="col-lg-8">
                            <input type="text"
                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                   name="name" value="{{ old('name') }}"
                                   placeholder="product name..."/>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Category') }}</label>
                        <div class="col-lg-8">
                            <select name="category_id" id="parent_id"
                                    class="form-control form-control-solid">
                                <option hidden="hidden"></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @if($category->id == old('id')) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Price') }}</label>
                        <div class="col-lg-8">
                            <input type="text"
                                   class="form-control form-control-solid @error('price')  is-invalid @enderror"
                                   name="price" value="{{ old('price') }}"
                                   placeholder="price..."/>
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Quantity') }}</label>
                        <div class="col-lg-8">
                            <input type="number"
                                   class="form-control form-control-solid @error('quantity')  is-invalid @enderror"
                                   name="quantity" value="{{ old('quantity') }}"
                                   placeholder="quantity..."/>
                            @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Product Features') }}</label>
                            <div class="form-group col ">
                                <div class="form-group row ">
                                    <label class="col-form-label col-lg-2">{{ __('Sizes') }}</label>
                                    <div class="col-10 col-form-label">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[sizes][]" value="xs"/>
                                                <span></span>
                                                xs
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[sizes][]" value="s"/>
                                                <span></span>
                                                s
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[sizes][]" value="m"/>
                                                <span></span>
                                                m
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[sizes][]" value="l"/>
                                                <span></span>
                                                l
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[sizes][]" value="xl"/>
                                                <span></span>
                                                xl
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[sizes][]" value="xxl"/>
                                                <span></span>
                                                xxl
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-form-label col-lg-2">{{ __('Colors') }}</label>
                                    <div class="col-10 col-form-label">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[colors][]" value="white"/>
                                                <span></span>
                                                white
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[colors][]" value="black"/>
                                                <span></span>
                                                black
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[colors][]" value="red"/>
                                                <span></span>
                                                red
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[colors][]" value="blue"/>
                                                <span></span>
                                                blue
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[colors][]" value="green"/>
                                                <span></span>
                                                green
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" name="variants[colors][]" value="yellow"/>
                                                <span></span>
                                                yellow
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Description') }}</label>
                        <div class="col-lg-8">
                                            <textarea type="text"
                                                      class="form-control form-control-solid @error('desc')  is-invalid @enderror"
                                                      name="description" value="{{ old('desc') }}"
                                                      placeholder="write a short description..."></textarea>
                            @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Status</label>
                        <div class="col-8 col-form-label">
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="radio" checked="checked" name="status" value="active"/>
                                    <span></span>
                                    Active
                                </label>
                                <label class="checkbox">
                                    <input type="radio" name="status" value="draft"/>
                                    <span></span>
                                    Draft
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="AddCategory">Add</button>
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
                processing: true,
                serverSide: true,
                ajax: "{{ Route('products.index') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'slug',
                        name: 'slug',
                    },
                    {
                        data: 'seller',
                        name: 'seller',
                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });

        });
    </script>
@endpush


