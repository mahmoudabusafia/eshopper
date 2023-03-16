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
                            <form class="form" action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Role Name') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                                   name="name" value="{{ old('name', $role->name) }}"
                                                   placeholder="role name..."/>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Abilities</label>
                                        <div class="col-6 col-form-label">
                                            <div class="checkbox-list">
                                                @foreach(config('abilities') as $ability => $title)
                                                    <label class="checkbox">
                                                        <input type="checkbox"  name="abilities[]" value="{{$ability}}" @if(in_array($ability, ($role->abilities ?? []))) checked @endif/>
                                                        <span></span>
                                                        {{$title}}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="AddCategory">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>                        </div>
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
