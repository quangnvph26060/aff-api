@extends('layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0 font-size-18">Thêm Danh Mục</h4>
    
</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <form action="{{ route('admin.category.store') }}" method="POST">    
            @csrf                  
          <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Danh Mục<span class="text text-danger">*</span></label>
                        <input value="" required class="form-control" name="name" type="text" id="example-text-input">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Mô tả</label>
                        <input value="" required class="form-control" name="description" type="text" id="example-text-input">
                    </div>
                     
                </div>
                <div class="col-lg-12">
                    <div>
                        <button type="submit" class="btn btn-primary w-md">
                            Xác nhận
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div> <!-- end col -->
</div>
<!-- end row -->

</div> <!-- container-fluid -->
</div>
@endsection