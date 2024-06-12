
@extends('layouts.app')
@section('content')
<script>
    document.getElementById('images').addEventListener('change', function(event) {
      const files = event.target.files;
      if (files.length > 4) {
        alert('Bạn chỉ được chọn tối đa 4 ảnh.');
        event.target.value = ''; // Xóa lựa chọn để người dùng chọn lại
      }
    });
  </script>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Sửa Sản Phẩm</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <form action="{{ route('admin.product.edit.submit', ['id'=> $product->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input required class="form-control" name="name" type="text"
                                                    id="example-text-input" value="{{ $product->name }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Ảnh sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                {{-- <input value="" required class="form-control" name="images"
                                                    type="file" id="example-text-input"> --}}
                                                <input id="images" class="form-control" type="file" name="images[]"
                                                    multiple accept="image/*" required>

                                            </div>
                                            {{-- <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="normal">Ảnh</label>
                                                    <div style="display: flex">
                                                        @foreach ($product->images as $item )
                                                        <div class="span8"  style="margin-right: 20px">
                                                            <iframe id="iframe_upload"
                                                                style="width: 200px; height: 150px;" rel="nofollow"
                                                                src="{{  asset( $item->image_path) }}" frameborder="0"
                                                                scrolling="no"></iframe>
                                                            <input id="thumb" name="thumb" type="hidden"
                                                                value="{{$item->image_path }}" />
                                                            <p class="error" id="error_anh"></p>
                                                        </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div> --}}
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Giá sản phẩm
                                                    <span class="text text-danger">*</span></label>
                                                <input required class="form-control" name="price" type="number"
                                                    id="example-search-input" value="{{ $product->price }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Số lượng <span
                                                        class="text text-danger">*</span></label>
                                                <input required class="form-control" name="quantity" type="number"
                                                    id="example-email-input" value="{{ $product->quantity }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Hoa Hồng <span
                                                        class="text text-danger">*</span></label>
                                                <input required class="form-control" name="commission_rate"
                                                    type="number" id="example-email-input"
                                                    value="{{ $product->commission_rate }}">
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Loại Danh
                                                    Mục<span class="text text-danger">*</span></label>
                                                <select class="form-control" name="category_id" id="" required>
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($category as $item )
                                                    <option {{ $product->category_id == $item->id ? 'selected' : ''
                                                        }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Mô tả <span
                                                        class="text text-danger">*</span></label>
                                                <textarea class="form-control" id="example-url-input" name="description"
                                                    rows="2" required> {{ $product->description }}</textarea>
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Trạng thái<span
                                                        class="text text-danger">*</span></label>
                                                <select class="form-control" name="status" id="">
                                                    <option value="">Chọn trạng thái</option>
                                                    <option {{ $product->status == 'published' ? 'selected' : '' }}
                                                        value="published">published</option>
                                                    <option {{ $product->status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">inactive</option>
                                                    <option {{ $product->status == 'scheduled' ? 'selected' : '' }}
                                                        value="scheduled">scheduled</option>
                                                </select>
                                            </div>
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
