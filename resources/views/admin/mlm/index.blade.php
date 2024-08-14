@extends('layouts.app')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container form-container">
                <div class="modal-header mb-3">
                    <p class="fs-24">Cài đặt tiếp thị</p>
                </div>

                <h4>Trạng thái</h4>
                
                <!-- Radio buttons -->
                <div class="mb-3 d-flex justify-content-start">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="enabled" onclick="handleRadioClick(this.value)" {{$affSetting->status === "enabled" ? "checked":"" }}>
                        <label class="form-check-label" for="inlineRadio1">Cho phép</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="disabled" onclick="handleRadioClick(this.value)" {{$affSetting->status === "disabled" ? "checked":"" }}>
                        <label class="form-check-label" for="inlineRadio2">Vô hiệu hóa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="custom" onclick="handleRadioClick(this.value)" {{$affSetting->status === "custom" ? "checked":"" }}>
                        <label class="form-check-label" for="inlineRadio3">Chỉ tắt cho những người được chọn</label>
                    </div>
                </div>

                <!-- Paragraph displayed based on selected option -->
                <p id="message1" class="hidden mt-3">Bạn đã chọn tùy chọn Cho phép.</p>
                <p id="message2" class="hidden mt-3">Bạn đã chọn tùy chọn Vô hiệu hóa.</p>
                <p id="message3" class="hidden mt-3">
                    Bạn đã chọn tùy chọn Chỉ tắt cho những người được chọn. 
                    <div id="message3-select" class="custom-select-container hidden" style="overflow-y: auto;">
                        @foreach($userAffilate as $item )
                            <div class="custom-select">
                                <input type="checkbox" id="option1" name="{{$item->id}}" value="{{$item->id}}" {{$item->is_commission_disabled === 1 ? "checked" : ""}}>
                                <label for="option1">{{$item->email}}</label>
                            </div>
                        @endforeach
                    </div>
                </p>

                <!-- Select inputs -->
                <h4>Set hoa hồng cho từng tầng</h4>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mb-3">
                    <form action="{{ route('admin.commissions.update') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Tỷ lệ phần trăm (%)</th>
                                        <th style="width: 10%" >Trạng thái </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commissionRates as $rate)
                                        <tr>
                                            <td>{{ $rate->level }}</td>
                                            <td>
                                                <input type="number" name="commissions[{{ $rate->level }}]" value="{{ $rate->rate }}" class="form-control" step="0.01" required>
                                            </td>
                                            <td>
                                                <div class="toggle-container">
                                                    <input data-id="{{$rate->id}}" type="checkbox" id="toggle{{$rate->id}}" {{$rate->status == 1  ? "checked" : ""}} value="{{$rate->status}}" class="toggle-checkbox">
                                                    <label for="toggle{{$rate->id}}" class="toggle-label">
                                                        <span class="toggle-knob"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
                {{-- <button class="btn btn-primary ">Lưu</button> --}}
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.toggle-checkbox');
        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function(event) {
                const idCommission = event.target.getAttribute('id').replace('toggle', '');
                // Gọi API với fetch
                const formData = new FormData();
                    formData.append('id', idCommission);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        url: '{{ route("admin.commissions.status") }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                        
                    }   
                });

            });
        });
    });
        var formEconomyEdit = {
            'category': {
                'element': document.getElementById('category'),
                'error': document.getElementById('category_error'),
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E003')
                }, ]
            },
        }

        function submitForm(event) {
            event.preventDefault();
            if (validateAllFields(formEconomyEdit)) {
                document.getElementById('categorySearchForm').submit();
            }
        }
        function handleRadioClick(value) {
            var messages = {
                'enabled': 'message1',
                'disabled': 'message2',
                'custom': 'message3'
            };
            for (var key in messages) {
                var message = document.getElementById(messages[key]);
                if (value === key) {
                    message.classList.remove('hidden');
                } else {
                    message.classList.add('hidden');
                }
            }
              // Hiển thị hoặc ẩn div chứa các checkbox dựa trên tùy chọn
            var checkboxContainer = document.getElementById('message3-select');
            if (value === 'custom') {
                checkboxContainer.classList.remove('hidden');
            } else {
                checkboxContainer.classList.add('hidden');
            }
             // Gửi yêu cầu cập nhật cài đặt qua API
            $.ajax({
                url: '/admin/aff-settings/update-status',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({ status: value }),
                contentType: 'application/json',
                success: function(data) {
                    console.log(data.message);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
            
        }
        document.querySelectorAll('#message3-select input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            $.ajax({
                url: '/admin/update-commission-status',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    id: this.value,
                    is_commission_disabled: this.checked ? 1 : 0
                }),
                contentType: 'application/json',
                success: function(data) {
                    console.log(data.message);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });

    </script>
    <style>
         .custom-select-container {
            width: 300px; /* Adjust width as needed */
            max-height: 100px; /* Adjust height as needed */
            overflow-y: 30px; /* Add vertical scrollbar */
            border: 1px solid #ccc; /* Border around the container */
            border-radius: 4px; /* Rounded corners */
            padding: 10px; /* Add padding inside the container */
            background-color: #fff; /* Background color */
        }
        @media(max-width:768px){
            .custom-select-container{
                width: 100%;
            }
        }
      /* Style for each checkbox item */
      .custom-select {
          display: flex;
          align-items: center;
          margin-bottom: 8px; /* Space between items */
      }

      /* Style for labels */
      .custom-select label {
          margin-left: 8px; /* Space between checkbox and label */
      }

      /* Optional: Style for checked checkboxes */
      .custom-select input[type="checkbox"]:checked + label {
          font-weight: bold; /* Change label text style when checked */
      }
        .form-container {
            margin-left: 10px;
        }

        .modal-header {
            border-radius: 10px;
            background: #5156be;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-header p {
            color: white;
            margin: 0;
        }

        .hidden {
            display: none;
        }
        .fs-24{
            font-size: 24px;
        }
        .toggle-container {
        display: flex;
        align-items: center;
    }

    .toggle-checkbox {
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

    .toggle-checkbox:checked + .toggle-label {
        background-color: #4caf50;
    }

    .toggle-checkbox:checked + .toggle-label .toggle-knob {
        transform: translateX(30px);
    }
    </style>
@endsection
