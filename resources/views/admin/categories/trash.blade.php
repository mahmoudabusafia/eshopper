@extends('admin.layouts.layout')


@section('body')
<div class="container">
<div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Trashed Categories</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Parent</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                        <tr>
                        <td><img src="{{ $category->image_url }}" alt="No Image yet" width="50" height="50"></td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_id }}</td>
                        <td>{{ $category->desc }}</td>
                        <td>{{ $category->status }}</td>
                        <td><a href="{{ route('categories.restore', $category->id) }}" class="btn btn-sm btn-dark">Restore</a></td>
                        <td><form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">Force Delete</button>
                        </form></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        {{ $categories->links() }}
</div>


@endsection