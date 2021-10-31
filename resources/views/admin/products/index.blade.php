@extends('layouts.admin')

@section('title')
<title>Product</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partial.content-header', ['name'=> 'Products', 'key'=> 'List'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-right m-2">
          <a href="{{ route('products.create') }}" class="btn btn-success">+ Add</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Path</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Content</th>
                <th scope="col">user_id</th>
                <th scope="col">category_id</th>
                <th scope="col">slug</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($listProducts as $value)
              <tr>
                <th scope="row">{{ $value['id'] }}</th>
                <td><img src="{{ $value['feature_image_path'] }}" alt="{{ $value['name'] }}" style="max-width: 100px; height: auto"></td>
                <td>{{ $value['name'] }}</td>
                <td>{{ $value['price'] }}</td>
                <td>{!! $value['content'] !!}</td>
                <td>{{ $value['user_id'] }}</td>
                <td>{{ $value['category_id'] }}</td>
                <td>{{ $value['slug'] }}</td>
                <td>
                  <a href="{{ route('products.edit', ['id' =>  $value['id']])}}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('products.delete', ['id' =>  $value['id']])}}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-12">

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

@endsection
