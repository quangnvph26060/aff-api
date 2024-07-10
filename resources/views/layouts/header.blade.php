<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset($config->logo ?? "") }}" alt="Logo" height="24" class="logo-img">
                        <span class="logo-text">{{ $config->name ?? "" }}</span>
                    </span>
                </a>
            </div>



            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M3 18v-2h18v2H3Zm0-5v-2h18v2H3Zm0-5V6h18v2H3Z" />
                </svg>
            </button>
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path stroke-linecap="round" d="m20 20l-3-3" />
                            </g>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img id="header-lang-img" src="https://quanlycongviec.site/libs/assets/images/flags/us.jpg"
                        alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">


                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                        <img src="https://quanlycongviec.site/libs/assets/images/flags/us.jpg" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="https://quanlycongviec.site/libs/assets/images/flags/spain.jpg" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>


                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="https://quanlycongviec.site/libs/assets/images/flags/germany.jpg" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>


                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                        <img src="https://quanlycongviec.site/libs/assets/images/flags/italy.jpg" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>


                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="https://quanlycongviec.site/libs/assets/images/flags/russia.jpg" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div> -->

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i data-feather="grid" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="https://quanlycongviec.site/libs/assets/images/brands/github.png"
                                        alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="https://quanlycongviec.site/libs/assets/images/brands/bitbucket.png"
                                        alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="https://quanlycongviec.site/libs/assets/images/brands/dribbble.png"
                                        alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="https://quanlycongviec.site/libs/assets/images/brands/dropbox.png"
                                        alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="https://quanlycongviec.site/libs/assets/images/brands/mail_chimp.png"
                                        alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="https://quanlycongviec.site/libs/assets/images/brands/slack.png"
                                        alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M11.997 21.385q-.668 0-1.14-.475q-.472-.474-.472-1.14h3.23q0 .67-.475 1.142q-.476.473-1.143.473M5 18.769v-1h1.615V9.846q0-1.96 1.24-3.447Q9.097 4.912 11 4.546V3h2v1.075q-.217.338-.38.683q-.164.344-.255.732l-.178-.02Q12.1 5.462 12 5.462q-1.823 0-3.104 1.28q-1.28 1.281-1.28 3.104v7.923h8.769V11.69q.238.047.49.073q.254.025.51.006v6H19v1zm11.964-9.365q-1.04 0-1.772-.729q-.73-.728-.73-1.769q0-1.04.728-1.771q.729-.731 1.77-.731q1.04 0 1.77.728t.732 1.77q0 1.04-.729 1.771q-.728.73-1.77.73" />
                    </svg>
                    <span class="badge bg-danger rounded-pill " id="order-count-badge"> {{ $orderCount ?? 0 }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Thông báo </h6>
                            </div>
                        </div>
                    </div>
                    <div class="custom-scroll">
                        @if(isset($dataOrder))
                            @foreach ($dataOrder as $order)
                                <div class="d-flex p-3 notification-item">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $order->name }} đã đặt 1 đơn hàng mới </h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                <span>{{ $order->created_at }}</span></p>
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <button type="button" class="btn-close" aria-label="Close"
                                            data-id="{{ $order->id }}"
                                            onclick="showOrderId(this.getAttribute('data-id'))">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 32 32">
                                                <path fill="currentColor"
                                                    d="M7.219 5.781L5.78 7.22L14.563 16L5.78 24.781l1.44 1.439L16 17.437l8.781 8.782l1.438-1.438L17.437 16l8.782-8.781L24.78 5.78L16 14.563z" />
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                        <!-- Thêm nhiều thông báo hơn ở đây -->
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>
            <!-- user login -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    <img class="rounded-circle header-profile-user"
                        src="{{ isset($loggedInUser['images']) ? asset($loggedInUser['images']) : asset('/users/avatar-1.jpg') }}"
                        alt="Image">




                    <span class="d-none d-xl-inline-block ms-1 fw-medium">

                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 16 16">
                        <path fill="currentColor" fill-rule="non-zero"
                            d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.552.552 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.552.552 0 0 0-.771 0" />
                    </svg>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.user-info') }}">
                        <svg xmlns="http://www.w3.org/200/svg" width="20" height="20"
                            viewBox="0 0 1408 1472">
                            <path fill="currentColor"
                                d="M704 128q-144 0-225 106t-81 271q-1 205 132 325q17 16 12 41l-23 48q-11 24-32.5 37.5T396 995q-3 1-126.5 41T138 1080q-84 35-110 73q-28 63-28 319h1408q0-256-28-319q-26-38-110-73q-8-4-131.5-44T1012 995q-69-25-90.5-38.5T889 919l-23-48q-5-25 12-41q133-120 132-325q0-165-81-271T704 128z" />
                        </svg>
                        Thông tin</a>
                    <!-- <a class="dropdown-item" href="auth-lock-screen.html"><i
                                    class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>
                            <div class="dropdown-divider"></div> -->
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <input type="hidden" value="web" name="type">
                        <button class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2">
                                    <path
                                        d="M14 8V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2v-2" />
                                    <path d="M9 12h12l-3-3m0 6l3-3" />
                                </g>
                            </svg>
                            Đăng xuất
                        </button>

                    </form>


                </div>
            </div>

        </div>
    </div>
</header>
<script></script>

<style scoped>
    .custom-scroll {
        max-height: 200px;
        overflow-y: auto;
    }

    .notification-item {
        position: relative;
    }

    .btn-close {
        background: none;
        border: none;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        color: #000;
    }
/* Styles for the brand box in the navbar */
.navbar-brand-box {
    display: flex;
    align-items: center;
    padding: 0 1rem;
}
.logo {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.logo-lg {
    display: flex;
    align-items: center;
}

.logo-img {
    height: 24px;
    margin-right: 10px;
}

.logo-text {
    font-family: 'Playwrite España Decorativa', sans-serif; !important /* Change this to your desired font family */
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    white-space: nowrap; /* Prevent text wrapping */
}
@media (max-width: 768px) {
    .navbar-brand-box {
        justify-content: center;
    }

    .logo-text {
        font-size: 1.2rem;
    }
}

</style>
