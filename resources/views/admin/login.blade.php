<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title>Đăng nhập Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- App favicon -->

    <!-- preloader css -->
    <link rel="stylesheet" href="{{asset('css/preloader.min.css')}}" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{asset('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
   
    <!-- App Css-->
    <link href="{{asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- validator -->
    <script src="{{asset('validator/validator.js')}}"></script>
</head>

<body>

    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-6 col-lg-6 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4 justify-content-center" >
                        <div class="main-layout-login">
                            <div class="d-flex flex-column h-100">
                               
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <div class="mb-4 mb-md-5 text-center">
                                            <a href="#" class="d-block auth-logo">
                                                <div id="logo" alt="Logo"> </div>
                                            </a>
                                        </div>
                                        <h5 class="mb-0">Đăng nhập Admin</h5>
                                    </div>
                                    <form method="POST" class="mt-4 pt-2" action="{{ route('login') }}" id="submitformlogin">
                                        @csrf
                                        <input name="type" type="hidden" class="form-control" id="username" value=" web">
                                        <div class="mb-3">
                                            <label class="form-label">Email hoặc số điện thoại</label>
                                            <input name="phone" type="text" class="form-control" id="phone">
                                            <span class="invalid-feedback d-block" style="font-weight: 500" id="phone_error"></span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Mật khẩu</label>
                                                </div>
                                            </div>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control" aria-label="Password" id="password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                                                        <path fill="currentColor" d="M8 6.003a2.667 2.667 0 1 1 0 5.334a2.667 2.667 0 0 1 0-5.334Zm0 1a1.667 1.667 0 1 0 0 3.334a1.667 1.667 0 0 0 0-3.334Zm0-3.336c3.076 0 5.73 2.1 6.467 5.043a.5.5 0 1 1-.97.242a5.67 5.67 0 0 0-10.995.004a.5.5 0 0 1-.97-.243A6.669 6.669 0 0 1 8 3.667Z" />
                                                    </svg>
                                                </button>
                                                <span class="invalid-feedback d-block" style="font-weight: 500" id="password_error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input name="remember" class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Ghi nhớ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" onclick="submitForm(event)">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">Affilate</p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-6 col-lg-6 col-md-5 main-banner-mobi">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary" ></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <!-- end carouselIndicators -->
                                        {{-- <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">“I feel confident
                                                        imposing change
                                                        on myself. It's a lot more progressing fun than looking back.
                                                        That's why
                                                        I ultricies enim
                                                        at malesuada nibh diam on tortor neaded to throw curve balls.”
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                <img src="" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Richard Drews
                                                                </h5>
                                                                <p class="mb-0 text-white-50">Web Designer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">“Our task must be to
                                                        free ourselves by widening our circle of compassion to embrace
                                                        all living
                                                        creatures and
                                                        the whole of quis consectetur nunc sit amet semper justo. nature
                                                        and its beauty.”</h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                <img src="#" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Rosanna French
                                                                </h5>
                                                                <p class="mb-0 text-white-50">Web Developer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">“I've learned that
                                                        people will forget what you said, people will forget what you
                                                        did,
                                                        but people will never forget
                                                        how donec in efficitur lectus, nec lobortis metus you made them
                                                        feel.”
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <img src="#" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            <div class="flex-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                                <p class="mb-0 text-white-50">Manager
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <!-- end carousel-inner -->
                                    </div>
                                    <!-- end review carousel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
    <script>
        const formlogin = {
            'phone': {
                'element': document.getElementById('phone'),
                'error': document.getElementById('phone_error'),
                'validations': [{
                        'func': function(value) {
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E026')
                    },
                    // {
                    //     'func': function(value) {
                    //         return checkEmail(value);
                    //     },
                    //     'message': generateErrorMessage('E012')
                    // },
                    // {
                    //     'func': function(value) {
                    //         return checkCharacterPhone(value);
                    //     },
                    //     'message': generateErrorMessage('E012')
                    // },
                ]
            },
            'password': {
                'element': document.getElementById('password'),
                'error': document.getElementById('password_error'),
                'validations': [{
                        'func': function(value) {
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E001')
                    },
                    {
                        'func': function(value) {
                            return checkLength(value, 8);
                        },
                        'message': generateErrorMessage('E002')
                    }
                ]
            }
        }

        function submitForm(event) {
            event.preventDefault();
            if (validateAllFields(formlogin)) {
                document.getElementById('submitformlogin').submit();
            }
        }
        fetch('/get-logo-banner')
            .then(response => response.json())
            .then(data => {
                document.getElementById('logo').innerHTML = `<img src="{{ config('app.url') }}/${data.logo}" alt="Logo" width="40%">`;
                document.getElementById('banner').innerHTML = `<img src="${data.banner}" alt="Banner">`;
            });
    </script>
</body>
<style scoped>
    .bg-primary {
        background-image: url('{{ asset($config->login_banner) }}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    .main-layout-login{
            width: 50% ;
    }
    @media(max-width:768px){
        .main-banner-mobi{
            display: none;
        }
        .main-layout-login{
            width: 100% ;
        }
    }
</style>
</html>
