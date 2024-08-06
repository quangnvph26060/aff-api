@extends('layouts.app')
@section('content')
@php
    $currentRouteName = Route::currentRouteName(); // lấy ra route name
    $id  = request()->route('id'); 
@endphp
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Danh sách đội nhóm</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-lg-4">
                                    <form method="GET" action="{{$currentRouteName === "admin.team" ? route('admin.team') : route('admin.member',['id'=>$id])}}" class="d-flex align-items-center">
                                        <div class="form-group me-3">
                                                <select name="filter" id="filter" class="form-select">
                                                <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Tất cả</option>
                                                <option value="has-purchase" {{ request('filter') == 'has-purchase' ? 'selected' : '' }}>Đã mua hàng</option>
                                                <option value="no-purchase" {{ request('filter') == 'no-purchase' ? 'selected' : '' }}>Chưa mua hàng</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
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
                                                <th>Tên người dùng</th>
                                                <th>Email</th>
                                                <th>Doanh số cá nhân</th>
                                                <th>Doanh số nhóm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teamMembers as $item)
                                                <tr>
                                                    <td>{{ $item['id'] }}</td>
                                                    <td>
                                                        <a href="{{route('admin.member',['id'=>$item['id']])}}">
                                                            {{ $item['name'] }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $item['email'] }}</td>
                                                    <td>{{ number_format($item['personal_sale']) }}</td>
                                                    <td>{{  number_format($item['team_sale']) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <nav>
                                    {{-- phân trang  --}}
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
