@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">All Roles
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                @can('create', \App\Models\Role::class)
                <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#roleAddModal">
        <span class="svg-icon svg-icon-md">
          <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24" />
              <circle fill="#000000" cx="9" cy="15" r="6" />
              <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
            </g>          </svg>
            <!--end::Svg Icon-->
        </span>Add Role
                </button>
                @endcan
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="table_id">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Users Count</th>
                    <th>Abilities</th>
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
<div class="modal fade" id="roleAddModal" tabindex="-1" role="dialog" aria-labelledby="roleAddModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row ">
                        <label class="col-form-label col-lg-4">{{ __('Role Name') }}</label>
                        <div class="col-lg-8">
                            <input type="text"
                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                   name="name" value="{{ old('name') }}"
                                   placeholder="role name..."/>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Abilities</label>
                        <div class="col-8 col-form-label">
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
                ajax: "{{ Route('roles.index') }}",
                columns: [
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'count',
                        name: 'count',
                    },
                    {
                        data: 'ability',
                        name: 'ability',
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





