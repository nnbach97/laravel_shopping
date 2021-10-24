@extends('layouts.admin')

@section('title')
<title>Product</title>
@endsection

@section('loadCSS')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/products/style.css') }}" rel="stylesheet" />

@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partial.content-header', ['name'=> 'Product', 'key'=> 'Add'])

  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content procuts">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Tên Product</label>
              <input type="text" class="form-control" placeholder="Nhập Tên Product" name="name">
            </div>

            <div class="form-group">
              <label>Price</label>
              <input type="number" min="0" max="100" class="form-control" placeholder="Nhập Tên price" name="price">
            </div>

            <div class="form-group">
              <label>Chọn ảnh đại diện</label>
              <input type="file" class="form-control-file" name="feature_image_path">
            </div>

            <div class="form-group">
              <label>Chọn List ảnh</label>
              <input type="file" class="form-control-file" name="image_path[]" multiple>
            </div>

            <div class="form-group">
              <label>Lựa chọn category</label>
              <select class="js-category-pro form-control" name="category_id">
                <option value="0">---Lựa chọn---</option>
                {!! $htmlOption !!}
              </select>
            </div>

            <div class="form-group">
              <label>Tags</label>
              <select class="form-control tags_select_choose" multiple="multiple">
              </select>
            </div>

            <div class="form-group">
              <label>Content</label>
              <textarea name="content" class="form-control my-editor" id="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

@endsection

@section('loadJS')
<script src="{{ asset('vendors/select2/select2.min.js') }}" defer></script>
<script src="{{ asset('vendors/file-manager/tinymce.min.js') }}"></script>
<script src="{{ asset('admin/products/script.js') }}" defer></script>

@endsection
