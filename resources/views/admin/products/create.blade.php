@extends('layouts.admin')

@section('title')
<title>Product</title>
@endsection

@section('loadCSS')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .procuts .select2-container .select2-selection--single {
    height: auto;
  }

  .procuts .form-control {
    padding: 0.175rem .75rem;
  }

  .procuts .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #524b4b;
  }
</style>
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
              <input type="file" class="form-control" name="feature_image_path">
            </div>

            <div class="form-group">
              <label>Chọn List ảnh</label>
              <input type="file" class="form-control" name="image_path[]" multiple>
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
              <textarea class="form-control" id="content" name="content" rows="3"></textarea>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.js-category-pro').select2();
  });
  $(".tags_select_choose").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  });
</script>
@endsection
