@extends('layouts.admin')

@section('title')
<title>Trang Home</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partial.content-header', ['name'=> 'Menu', 'key'=> 'Edit'])

  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('menus.update', ['id' => $dbItem['id']]) }}" method="post">
            @csrf
            <div class="form-group">
              <label>Tên Menu</label>
              <input type="text" class="form-control" placeholder="Nhập Tên Menu" name="name" value="{{ $dbItem['name'] }}">
            </div>
            <div class="form-group">
              <label>Lựa chọn menu cha</label>
              <select class="form-control" name="parent_id">
                <option value="0">---Lựa chọn---</option>
                {!! $htmlOption !!}
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
