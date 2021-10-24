@extends('layouts.admin')

@section('title')
<title>Menu</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partial.content-header', ['name'=> 'Menu', 'key'=> 'List'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-right m-2">
          <a href="{{ route('menus.create') }}" class="btn btn-success">+ Add</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Menu Parent</th>
                <th scope="col">Slug</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($listMenu as $value)
              <tr>
                <th scope="row">{{ $value['id'] }}</th>
                <td>{{ $value['name'] }}</td>
                <td>{{ $value['parent_id'] }}</td>
                <td>{{ $value['slug'] }}</td>
                <td>
                  <a href="{{ route('menus.edit', ['id' =>  $value['id']])}}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('menus.delete', ['id' =>  $value['id']])}}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          {{ $listMenu->links() }}
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

@endsection
