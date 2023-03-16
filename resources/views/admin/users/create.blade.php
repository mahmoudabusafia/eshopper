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
                                <h4 class="card-title">Create User</h4>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3">{{ __('Image') }}</label>
                                        <div class="col-lg-6">
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
                                        <label class="col-form-label col-lg-3">{{ __('User Name') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                                   name="name" value="{{ old('name') }}"
                                                   placeholder="User name"/>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Email') }}</label>
                                        <div class="col-lg-6">
                                            <input type="email"
                                                   class="form-control form-control-solid @error('email')  is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}"
                                                   placeholder="Email"/>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Phone Number') }}</label>
                                        <div class="col-lg-6">
                                            <input type="tel"
                                                   class="form-control form-control-solid @error('mobile')  is-invalid @enderror"
                                                   name="mobile" value="{{ old('mobile') }}"
                                                   placeholder="Phone number"/>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Password') }}</label>
                                        <div class="col-lg-6">
                                            <input type="password"
                                                   class="form-control form-control-solid @error('password')  is-invalid @enderror"
                                                   name="password" value="{{ old('password') }}"
                                                   placeholder="Password"/>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Confirm Password') }}</label>
                                        <div class="col-lg-6">
                                            <input type="password"
                                                   class="form-control form-control-solid @error('password_confirmation')  is-invalid @enderror"
                                                   name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                   placeholder="Confirm password"/>
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Type</label>
                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="radio" name="type" value="user"/>
                                                    <span></span>
                                                    User
                                                </label>
                                                <label class="checkbox">
                                                    <input type="radio" name="type" value="seller"/>
                                                    <span></span>
                                                    Seller
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
