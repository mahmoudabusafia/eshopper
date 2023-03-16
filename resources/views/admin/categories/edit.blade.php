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
                                <h4 class="card-title">Create Category</h4>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form" action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3">{{ __('Image') }}</label>
                                        <div class="col-lg-6">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper"
                                                     style="background-image: url({{ $category->image_url }});
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
                                        <label class="col-form-label col-lg-3">{{ __('Category Name') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                                   name="name" value="{{ old('name', $category->name) }}"
                                                   placeholder="category name..."/>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Parent') }}</label>
                                        <div class="col-lg-6">
                                            <select name="parent_id" id="parent_id"
                                                    class="form-control form-control-solid">
                                                <option value="">No Parent</option>
                                                @foreach($parents as $parent)
                                                    <option value="{{ $parent->id }}" @if($category->id == $parent->id) hidden="hidden" @endif
                                                            @if($category->parent_id == old('parent_id', $parent->id)) selected @endif>{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Description') }}</label>
                                        <div class="col-lg-6">
                                            <textarea type="text"
                                                      class="form-control form-control-solid @error('desc')  is-invalid @enderror"
                                                      name="desc" value="{{ old('desc') }}"
                                                      placeholder="write a short description...">{{ $category->desc }}</textarea>
                                            @error('desc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Status</label>
                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="radio" name="status" value="active" @if($category->status !== 'draft') checked="checked" @endif/>
                                                    <span></span>
                                                    Active
                                                </label>
                                                <label class="checkbox">
                                                    <input type="radio" name="status" value="draft" @if($category->status == 'draft') checked="checked" @endif/>
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
                                            <button type="submit" class="btn btn-primary font-weight-bold mr-2">Save
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
