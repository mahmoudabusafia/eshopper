@extends('admin.layouts.layout')

@section('content')

    <div class="container" style="margin-top: -60px">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">Update Role</h4>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('roleUser.update', $roleUser->role_id.'-'.$roleUser->user_id)}}" class="form"  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Role name') }}</label>
                                        <div class="col-lg-6">
                                            <select name="role_id" id="role_id"
                                                    class="form-control form-control-solid">
                                                <option id="my-select" value="_" selected >select role...</option>
                                                @foreach($roles as $role)
                                                    <option id="{{ $role->id }}role" value="{{ $role->id }}" @if($role->id == old('role_id', $roleUser->role_id)) selected @endif>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('User name') }}</label>
                                        <div class="col-lg-6">
                                            <select name="user_id" id="user_id"
                                                    class="form-control form-control-solid">
                                                <option value="">select user...</option>
                                                @foreach($users as $user)
                                                    <option id="{{ $user->id }}user" value="{{ $user->id }}" @if($user->id == old('user_id', $roleUser->user_id)) selected @endif>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="roleUpdate">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                            <!-- /.form -->
                        </div>
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">
                    </div>
                    <!--/.col (right) -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

@endsection

@push('script')
    let avatar1 = new KTImageInput('kt_image_1');
@endpush
