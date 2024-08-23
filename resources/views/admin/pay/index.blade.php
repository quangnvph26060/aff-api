@extends('layouts.app')
@section('content')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('loc_category').addEventListener('change', function() {
                var selectedValue = this.value;
                if (selectedValue) {
                    window.location.href = selectedValue;
                }
            });
        });
    </script>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{$title}} </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="">
                                <div class="row ">
                                  
                                    {{-- <div class="col-lg-7">
                                    <form class="col-lg-4" action="" method="get">
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="exampleSelect" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="loc_category" name="category">
                                                <option value="}">--- Loại sản phẩm ---</option>
                                                @foreach ($category as $item)
                                                <option value="{{ route('admin.product.filter', ['id'=> $item->id]) }}">
                                                    {{
                                                    $item->name }}</option>
                                                @endforeach
                                                <option value="{{ route('admin.product.store')}}"> Danh sách tất cả các
                                                    sản phẩm</option>
                                            </select>
                                        </div>
                                    </form>
                                </div> --}}
                                </div>


                                <div style="float: right">
                                    <button class="btn btn-primary" popovertarget='add-method'>Thêm phương thức thanh toán</button>
                                </div>
                                <div
                                    popover
                                    id="add-method"
                                >

                                   <form action="{{route('admin.pay.add')}}" method="post">
                                        @csrf
                                        <div class="d-flex flex-column gap-2 ">
                                            <label for="">Thêm {{$title}}</label>
                                            <input type="text" class="from-contol" name="namepay">
                                            <button class="btn btn-primary">Lưu</button>
                                        </div>
                                   </form>
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('fail'))
                                <div class="alert alert-success">
                                    {{ session('fail') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Phương thức</th>
                                                    <th>Trạng thái</th>
                                                    <th style="text-align: center">Hành động</th>
                                                </tr>
                                            </thead>
                                            @if ($data->count() > 0)
                                                <tbody>

                                                    @foreach ($data as $key => $value)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>@truncate($value->name)</td>
                                                          
                                                            <td>
                                                                <div class="toggle-container">
                                                                    <input type="checkbox"
                                                                        id="toggle{{ $value->id }}"
                                                                        {{ $value->active == 1 ? 'checked' : '' }}
                                                                        value="{{ $value->id }}"
                                                                        class="toggle-checkbox">
                                                                    <label for="toggle{{ $value->id }}"
                                                                        class="toggle-label">
                                                                        <span class="toggle-knob"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <form action="{{ route('admin.pay.delete', ['id' => $value->id]) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa phương thức thanh toán không?');">Xóa</button>
                                                                </form>
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <tbody>
                                                    <td class="text-center" colspan="10">
                                                        <div class="">
                                                            Không có sản phẩm cần tìm
                                                        </div>
                                                    </td>
                                                </tbody>
                                            @endif
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <script>
              document.addEventListener('DOMContentLoaded', function() {
                   // change đặc trưng
                const checkboxes = document.querySelectorAll('.toggle-checkbox');
                checkboxes.forEach((checkbox, index) => {
                    checkbox.addEventListener('change', function(event) {
                        const value = event.target.value;
                        const isChecked = this.checked ? 1 : 0;
                        // Gọi API với fetch
                        const formData = new FormData();
                        formData.append('id_pay', value);
                        formData.append('status', isChecked);
                        formData.append('_token', '{{ csrf_token() }}');
                        $.ajax({
                            url: '{{ route('admin.pay.update.status') }}',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {

                            },
                            error: function(jqXHR, textStatus, errorThrown) {

                            }
                        });

                    });
                });
            });
            var validateaddproduct = {
                'name': {
                    'element': document.getElementById('name'),
                    'error': document.getElementById('name_error'),
                    'validations': [{
                        'func': function(value) {
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0018')
                    }, ]
                },
            };

            function searchProduct(event) {
                event.preventDefault();
                if (validateAllFields(validateaddproduct)) {
                    document.getElementById('brandSearchForm').submit();
                }
            }
        </script>
        <style scoped>
            .trang-thai {
                display: block !important;
            }
            .toggle-container {
                display: flex;
                align-items: center;
            }

            .toggle-checkbox {
                display: none;
            }

            .toggle-checkbox-approve {
                display: none;
            }

            .toggle-label {
                display: flex;
                align-items: center;
                cursor: pointer;
                width: 60px;
                height: 30px;
                background-color: #ccc;
                border-radius: 30px;
                position: relative;
                transition: background-color 0.3s ease;
            }
            .toggle-knob {
                width: 26px;
                height: 26px;
                background-color: white;
                border-radius: 50%;
                position: absolute;
                top: 2px;
                left: 2px;
                transition: transform 0.3s ease;
            }

            .toggle-checkbox:checked+.toggle-label {
                background-color: #4caf50;
            }

            .toggle-checkbox:checked+.toggle-label .toggle-knob {
                transform: translateX(30px);
            }

            .toggle-checkbox-approve:checked+.toggle-label {
                background-color: #4caf50;
            }

            .toggle-checkbox-approve:checked+.toggle-label .toggle-knob {
                transform: translateX(30px);
            }
            
        </style>
    @endsection
