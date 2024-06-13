@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .close-icon {
        position: absolute;
        top: -5px;
        right: 0px;
        text-decoration: none;
        color: #000;
        font-size: 20px;
    }

    .close-icon {
        color: rgb(234, 250, 12)
    }

    .close-icon:hover {
        color: #fd0e0e;
    }
</style>
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
                            @if (session('success'))
                            <div class="alert alert-success h-10  mb-2 p-2 col-lg-6">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{ route('admin.product.edit.submit', ['id'=> $product->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input class="form-control" name="name" type="text"
                                                    id="example-text-input" value="{{ $product->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Ảnh sản phẩm <span
                                                        class="text text-danger"></span></label>

                                                <input id="images" class="form-control" type="file" name="images[]"
                                                    multiple accept="image/*">
                                                <div style="display: flex">
                                                    @foreach($product->images as $key => $item)
                                                    <div
                                                        style="position: relative; margin-top: 10px; margin-right: 10px;">
                                                        <img title="{{ $item->image_path }}"
                                                            style="width: 100px; height: 75px;"
                                                            src="{{ asset($item->image_path) }}" alt="">
                                                        <a title="Xóa"
                                                            href="{{ route('admin.deleteImagesProduct', ['id'=>$item->id]) }}"
                                                            class="close-icon">
                                                            <i class="fas fa-minus-square"></i>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

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
                                                    type="number" id="example-email-input" max="100"
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
                                                        value="published">Được phát hành</option>
                                                    <option {{ $product->status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">Không hoạt động</option>
                                                    <option {{ $product->status == 'scheduled' ? 'selected' : '' }}
                                                        value="scheduled">Lên kế hoạch</option>
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
