@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{$title ?? 'Danh sách bình luận'}}</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-lg-4">
                                    <form action="" method="post">
                                        <div class="form-group d-flex col-7">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Nhập tìm kiếm">
                                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-rep-plugin">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên sản phẩm</th>
                                                @if(isset($is_flag))
                                                    <th> Nội dung </th>
                                                    <th> Người đánh giá </th>
                                                @endif
                                                <th>Điểm dánh giá</th>
                                                @if(isset($is_flag))
                                                    <th>Thao tác</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach ($data as  $index=>$item)
                                                <tr>
                                                    <td>{{ $index+1 }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.comment.find', ['id' => $item->product_id]) }}">
                                                            {{ $item->product_name ?? ""}}
                                                        </a>
                                                    </td>
                                                    @if(isset($is_flag))
                                                        <td> {{$item->content}} </td>
                                                        <td>{{$item->name}}</td>
                                                    @endif
                                                    <td>{{ round($item->average_rate ?? $item->rate ) ?? "" }}/5</td>
                                                    @if(isset($is_flag))
                                                    <td>
                                                        <form action="{{ route('admin.comments.delete', $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                                        </form>
                                                        
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <nav>
                                  
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
  $(document).on('click', '.delete-comment', function(e) {
    e.preventDefault();
    
    var id = $(this).data('id'); // Lấy ID từ thuộc tính data-id của nút xóa
    var url = '/comments/' + id; // Đường dẫn đến phương thức xóa

    $.ajax({
        url: url,
        type: 'DELETE', // Phương thức DELETE để xóa
        success: function(response) {
            if (response.status === 'success') {
                // Xóa phần tử bình luận từ DOM
                $('#comment-' + id).remove();
                alert(response.message); // Hiển thị thông báo thành công
            } else {
                alert(response.message); // Hiển thị thông báo lỗi
            }
        },
        error: function(xhr) {
            alert('An error occurred while deleting the comment.');
        }
    });
});

</script>
