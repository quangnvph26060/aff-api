@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Danh sách công tác viên</h4>
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
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Vai trò</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as  $index=>$item)
                                                <tr>
                                                    <td>{{ $index+1 }}</td>
                                                   <td>{{$item['name']}}</td>
                                                    <td>{{ $item['email'] }}</td>
                                                    <td> {{$item['phone']}}</td>
                                                    <td> {{$item['role_id'] === 2 ? "Công tác viên" :""}}</td>
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
