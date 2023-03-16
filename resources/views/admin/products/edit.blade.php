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
                            <div class="card-header">
                                <h4 class="card-title">Create Product</h4>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3">{{ __('Image') }}</label>
                                        <div class="col-lg-6">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper"
                                                     style="background-image: url({{ $product->image_url }});
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
                                        <label class="col-form-label col-lg-3">{{ __('Product Name') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                                   name="name" value="{{ old('name', $product->name) }}"
                                                   placeholder="product name..."/>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Category') }}</label>
                                        <div class="col-lg-6">
                                            <select name="category_id" id="parent_id"
                                                    class="form-control form-control-solid">
                                                <option hidden="hidden"></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @if($category->id == old('id', $product->category_id)) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Price') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('price')  is-invalid @enderror"
                                                   name="price" value="{{ old('price', $product->price) }}"
                                                   placeholder="price..."/>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Quantity') }}</label>
                                        <div class="col-lg-6">
                                            <input type="number"
                                                   class="form-control form-control-solid @error('quantity')  is-invalid @enderror"
                                                   name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                                   placeholder="quantity..."/>
                                            @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Description') }}</label>
                                        <div class="col-lg-6">
                                            <textarea type="text"
                                                      class="form-control form-control-solid @error('description')  is-invalid @enderror"
                                                      name="description" value="{{ old('description') }}"
                                                      placeholder="write a short description...">{{ $product->description }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Status</label>
                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="radio" name="status" value="active" @if($product->status !== 'draft') checked="checked" @endif/>
                                                    <span></span>
                                                    Active
                                                </label>
                                                <label class="checkbox">
                                                    <input type="radio" name="status" value="draft" @if($product->status == 'draft') checked="checked" @endif/>
                                                    <span></span>
                                                    Draft
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <button type="submit" class="btn btn-primary font-weight-bold mr-2">Submit
                                            </button>
                                            <button type="submit" class="btn btn-light-primary font-weight-bold">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

@push('script')
    let avatar1 = new KTImageInput('kt_image_1');
@endpush
