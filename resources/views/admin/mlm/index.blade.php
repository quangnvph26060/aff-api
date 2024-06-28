@extends('layouts.app')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container form-container">
                <div class="modal-header mb-3">
                    <p class="fs-24">Cài đặt tiếp thị</p>
                </div>

                <p>Trạng thái</p>
                <!-- Radio buttons -->
                <div class="mb-3 d-flex justify-content-start">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1" onclick="handleRadioClick(this.value)">
                        <label class="form-check-label" for="inlineRadio1">Cho phép</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2" onclick="handleRadioClick(this.value)">
                        <label class="form-check-label" for="inlineRadio2">Vô hiệu hóa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option3" onclick="handleRadioClick(this.value)">
                        <label class="form-check-label" for="inlineRadio3">Chỉ tắt cho những người được chọn</label>
                    </div>
                </div>

                <!-- Paragraph displayed based on selected option -->
                <p id="message1" class="hidden mt-3">Bạn đã chọn tùy chọn Cho phép.</p>
                <p id="message2" class="hidden mt-3">Bạn đã chọn tùy chọn Vô hiệu hóa.</p>
                <p id="message3" class="hidden mt-3">Bạn đã chọn tùy chọn Chỉ tắt cho những người được chọn.</p>

                <!-- Select inputs -->
                <div class="mb-3">
                    <label for="select1" class="form-label">Select 1</label>
                    <select class="form-select" id="select1">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="select2" class="form-label">Select 2</label>
                    <select class="form-select" id="select2">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="select3" class="form-label">Select 3</label>
                    <select class="form-select" id="select3">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <button class="btn btn-primary ">Lưu</button>
            </div>

            <script>
                function handleRadioClick(value) {
                    var messages = {
                        'option1': 'message1',
                        'option2': 'message2',
                        'option3': 'message3'
                    };

                    for (var key in messages) {
                        var message = document.getElementById(messages[key]);
                        if (value === key) {
                            message.classList.remove('hidden');
                        } else {
                            message.classList.add('hidden');
                        }
                    }
                }
            </script>
        </div>
    </div>
    <script>
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
    </script>
    <style>
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
    </style>
@endsection
