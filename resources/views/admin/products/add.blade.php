@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Thêm Sản Phẩm</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-body p-4">
                            <form action="{{ route('admin.product.add.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="name" type="text"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Ảnh sản phẩm <span
                                                        class="text text-danger">*</span></label>

                                                <input id="images" class="form-control" type="file" name="images[]"
                                                    multiple accept="image/*" required>

                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Giá sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="price" type="number"
                                                    id="example-search-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Số lượng <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="quantity"
                                                    type="number" id="example-email-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Hoa Hồng <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="commission_rate"
                                                    type="number" id="example-email-input" max="100">
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Loại Danh Mục<span
                                                        class="text text-danger">*</span></label>
                                                <select class="form-control" name="category_id" id="" required>
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($category as $item )
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Mô tả <span
                                                        class="text text-danger">*</span></label>
                                                <textarea class="form-control" id="example-url-input" name="description"
                                                    rows="2" ></textarea>
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Trạng thái<span
                                                        class="text text-danger">*</span></label>
                                                <select class="form-control" name="status" id="" >
                                                    <option value="">Chọn trạng thái</option>
                                                    <option value="published">Được phát hành</option>
                                                    <option value="inactive">Không hoạt động</option>
                                                    <option value="scheduled">Lên kế hoạch</option>
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
