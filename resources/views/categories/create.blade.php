@extends('layouts.admin')

@section('title')
<title>Trang Home</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partial.content-header', ['name'=> 'Categories', 'key'=> 'Add'])

  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label>Tên Danh Mục</label>
              <input type="text" class="form-control" placeholder="Nhập Tên Danh Mục">
            </div>
            <div class="form-group">
              <label>Lựa chọn danh mục cha</label>
              <select class="form-control">
                <option value="0">---Lựa chọn---</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
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
