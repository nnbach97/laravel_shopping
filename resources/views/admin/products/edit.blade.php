@extends('layouts.admin')

@section('title')
<title>Product</title>
@endsection

@section('loadCSS')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/products/style.css') }}" rel="stylesheet" />

@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partial.content-header', ['name'=> 'Product', 'key'=> 'Edit'])

  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content procuts">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Tên Product</label>
              <input type="text" class="form-control" placeholder="Nhập Tên Product" name="name" value="{{ $product->name }}">
            </div>

            <div class="form-group">
              <label>Price</label>
              <input type="number" min="0" class="form-control" placeholder="Nhập Tên price" name="price" value="{{ $product->price }}">
            </div>

            <div class="form-group">
              <label>Chọn ảnh đại diện</label>
              <input type="file" class="form-control-file" name="feature_image_path">
              <div class="col-md-4 feature_image_container">
                <div class="row">
                  <img class="feature_image" src="{{ $product->feature_image_path }}" alt="{{ $product->name }}" style="max-width: 350px; padding: 10px;">
                </div>
              </div>

              <div class="form-group">
                <label>Chọn List ảnh</label>
                <input type="file" class="form-control-file" name="image_path[]" multiple>
                <div class="col-md-12 feature_image_container">
                  <div class="row d-flex">
                    @foreach($product->images as $productImage)
                    <img class="feature_image" src="{{ $productImage->image_path }}" alt="{{ $productImage->image_name }}" style="max-width: 220px; padding: 10px;">
                    @endforeach
                  </div>
                </div>
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
                <select class="form-control tags_select_choose" multiple="multiple" value="{{ $product->tag }}" name="tags[]">
                  @foreach($product->tags as $tag)
                  <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Content</label>
                <textarea name="contents" class="form-control my-editor" id="content" rows="3">{{ $product->content }}</textarea>
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
<script src="{{ asset('admins/products/script.js') }}" defer></script>

@endsection
