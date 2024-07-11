<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- <li class="menu-title" data-key="t-menu">Menu</li> --}}
                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                <path d="M6.133 21C4.955 21 4 20.02 4 18.81v-8.802c0-.665.295-1.295.8-1.71l5.867-4.818a2.09 2.09 0 0 1 2.666 0l5.866 4.818c.506.415.801 1.045.801 1.71v8.802c0 1.21-.955 2.19-2.133 2.19H6.133Z" />
                                <path d="M9.5 21v-5.5a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2V21" />
                            </g>
                        </svg>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title mt-2" data-key="t-components">Quản lý</li>
                <li>
                    <a href="{{route('admin.config')}}" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024">
                            <path fill="currentColor" d="M600.704 64a32 32 0 0 1 30.464 22.208l35.2 109.376c14.784 7.232 28.928 15.36 42.432 24.512l112.384-24.192a32 32 0 0 1 34.432 15.36L944.32 364.8a32 32 0 0 1-4.032 37.504l-77.12 85.12a357.12 357.12 0 0 1 0 49.024l77.12 85.248a32 32 0 0 1 4.032 37.504l-88.704 153.6a32 32 0 0 1-34.432 15.296L708.8 803.904c-13.44 9.088-27.648 17.28-42.368 24.512l-35.264 109.376A32 32 0 0 1 600.704 960H423.296a32 32 0 0 1-30.464-22.208L357.696 828.48a351.616 351.616 0 0 1-42.56-24.64l-112.32 24.256a32 32 0 0 1-34.432-15.36L79.68 659.2a32 32 0 0 1 4.032-37.504l77.12-85.248a357.12 357.12 0 0 1 0-48.896l-77.12-85.248A32 32 0 0 1 79.68 364.8l88.704-153.6a32 32 0 0 1 34.432-15.296l112.32 24.256c13.568-9.152 27.776-17.408 42.56-24.64l35.2-109.312A32 32 0 0 1 423.232 64H600.64zm-23.424 64H446.72l-36.352 113.088l-24.512 11.968a294.113 294.113 0 0 0-34.816 20.096l-22.656 15.36l-116.224-25.088l-65.28 113.152l79.68 88.192l-1.92 27.136a293.12 293.12 0 0 0 0 40.192l1.92 27.136l-79.808 88.192l65.344 113.152l116.224-25.024l22.656 15.296a294.113 294.113 0 0 0 34.816 20.096l24.512 11.968L446.72 896h130.688l36.48-113.152l24.448-11.904a288.282 288.282 0 0 0 34.752-20.096l22.592-15.296l116.288 25.024l65.28-113.152l-79.744-88.192l1.92-27.136a293.12 293.12 0 0 0 0-40.256l-1.92-27.136l79.808-88.128l-65.344-113.152l-116.288 24.96l-22.592-15.232a287.616 287.616 0 0 0-34.752-20.096l-24.448-11.904L577.344 128zM512 320a192 192 0 1 1 0 384a192 192 0 0 1 0-384zm0 64a128 128 0 1 0 0 256a128 128 0 0 0 0-256z"/>
                        </svg>
                        <span data-key="t-apps">Cấu hình</span>
                    </a>
                    {{-- <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.team')}}">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2048 2048">
                            <path fill="currentColor" d="m960 120l832 416v1040l-832 415l-832-415V536l832-416zm625 456L960 264L719 384l621 314l245-122zM960 888l238-118l-622-314l-241 120l625 312zM256 680v816l640 320v-816L256 680zm768 1136l640-320V680l-640 320v816z" />
                        </svg>
                        <span data-key="t-apps">Quản lý Sản Phẩm</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ms-3">
                            <a href="{{ route('admin.product.add') }}">
                                <span data-key="t-calendar">Thêm mới</span>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a href="/admin/product">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7.885 10.23L12 3.463l4.115 6.769h-8.23Zm9.615 11q-1.567 0-2.65-1.08q-1.08-1.083-1.08-2.65t1.08-2.649q1.083-1.082 2.65-1.082t2.65 1.082q1.08 1.082 1.08 2.649t-1.081 2.65q-1.082 1.08-2.649 1.08Zm-13.73-.5v-6.46h6.46v6.46H3.77Zm13.73-.5q1.146 0 1.938-.791q.793-.792.793-1.938q0-1.147-.792-1.94q-.792-.792-1.938-.792q-1.147 0-1.94.792q-.792.792-.792 1.938q0 1.147.792 1.94q.792.792 1.938.792Zm-12.73-.5h4.46v-4.46H4.77v4.46Zm4.857-10.5h4.746L12 5.428L9.627 9.23Zm2.373 0Zm-2.77 6.04Zm8.27 2.23Z" />
                        </svg>
                        <span>Quản lý Danh Mục</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ms-3">
                            <a href="/admin/category/add">
                                <span data-key="t-calendar">Thêm mới</span>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a href="/admin/category/">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7.885 10.23L12 3.463l4.115 6.769h-8.23Zm9.615 11q-1.567 0-2.65-1.08q-1.08-1.083-1.08-2.65t1.08-2.649q1.083-1.082 2.65-1.082t2.65 1.082q1.08 1.082 1.08 2.649t-1.081 2.65q-1.082 1.08-2.649 1.08Zm-13.73-.5v-6.46h6.46v6.46H3.77Zm13.73-.5q1.146 0 1.938-.791q.793-.792.793-1.938q0-1.147-.792-1.94q-.792-.792-1.938-.792q-1.147 0-1.94.792q-.792.792-.792 1.938q0 1.147.792 1.94q.792.792 1.938.792Zm-12.73-.5h4.46v-4.46H4.77v4.46Zm4.857-10.5h4.746L12 5.428L9.627 9.23Zm2.373 0Zm-2.77 6.04Zm8.27 2.23Z" />
                        </svg>
                        <span>Quản lý Thương hiệu</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ms-3">
                            <a href="/admin/brand/add">
                                <span data-key="t-calendar">Thêm mới</span>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a href="/admin/brand/">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="14" height="17" x="5" y="4" rx="2" />
                                <path stroke-linecap="round" d="M9 9h6m-6 4h6m-6 4h4" />
                            </g>
                        </svg>
                        <span data-key="t-apps">Quản lý Đơn Hàng</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ms-3">
                            <a href="/admin/order/list">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M14 8a2 2 0 1 1 4 0a2 2 0 0 1-4 0m2-4a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-3 9a3 3 0 0 0-3 3v3.5a1 1 0 1 0 2 0V16a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v3.5a1 1 0 1 0 2 0V16a3 3 0 0 0-3-3zm-8.5 9A1.5 1.5 0 0 0 3 23.5A4.5 4.5 0 0 0 7.5 28h17a4.5 4.5 0 0 0 4.5-4.5a1.5 1.5 0 0 0-1.5-1.5zm3 4a2.5 2.5 0 0 1-2.45-2h21.9a2.5 2.5 0 0 1-2.45 2zm15.889-11H26a1 1 0 0 1 1 1v3.5a1 1 0 1 0 2 0V16a3 3 0 0 0-3-3h-3.646c.5.559.863 1.243 1.035 2M9.646 13H6a3 3 0 0 0-3 3v3.5a1 1 0 1 0 2 0V16a1 1 0 0 1 1-1h2.612a4.487 4.487 0 0 1 1.034-2M7.5 7a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3M4 8.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0m19 0a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0M24.5 5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7" />
                        </svg>
                        <span data-key="t-apps">Quản lý Đội Nhóm</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.team')}}">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M14 8a2 2 0 1 1 4 0a2 2 0 0 1-4 0m2-4a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-3 9a3 3 0 0 0-3 3v3.5a1 1 0 1 0 2 0V16a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v3.5a1 1 0 1 0 2 0V16a3 3 0 0 0-3-3zm-8.5 9A1.5 1.5 0 0 0 3 23.5A4.5 4.5 0 0 0 7.5 28h17a4.5 4.5 0 0 0 4.5-4.5a1.5 1.5 0 0 0-1.5-1.5zm3 4a2.5 2.5 0 0 1-2.45-2h21.9a2.5 2.5 0 0 1-2.45 2zm15.889-11H26a1 1 0 0 1 1 1v3.5a1 1 0 1 0 2 0V16a3 3 0 0 0-3-3h-3.646c.5.559.863 1.243 1.035 2M9.646 13H6a3 3 0 0 0-3 3v3.5a1 1 0 1 0 2 0V16a1 1 0 0 1 1-1h2.612a4.487 4.487 0 0 1 1.034-2M7.5 7a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3M4 8.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0m19 0a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0M24.5 5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7" />
                        </svg>
                        <span data-key="t-apps">Quản lý yêu cầu rút tiền</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.transaction.index')}}">
                                <span data-key="t-chat">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M14 8a2 2 0 1 1 4 0a2 2 0 0 1-4 0m2-4a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-3 9a3 3 0 0 0-3 3v3.5a1 1 0 1 0 2 0V16a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v3.5a1 1 0 1 0 2 0V16a3 3 0 0 0-3-3zm-8.5 9A1.5 1.5 0 0 0 3 23.5A4.5 4.5 0 0 0 7.5 28h17a4.5 4.5 0 0 0 4.5-4.5a1.5 1.5 0 0 0-1.5-1.5zm3 4a2.5 2.5 0 0 1-2.45-2h21.9a2.5 2.5 0 0 1-2.45 2zm15.889-11H26a1 1 0 0 1 1 1v3.5a1 1 0 1 0 2 0V16a3 3 0 0 0-3-3h-3.646c.5.559.863 1.243 1.035 2M9.646 13H6a3 3 0 0 0-3 3v3.5a1 1 0 1 0 2 0V16a1 1 0 0 1 1-1h2.612a4.487 4.487 0 0 1 1.034-2M7.5 7a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3M4 8.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0m19 0a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0M24.5 5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7" />
                        </svg>
                        <span data-key="t-apps">MLM</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.mlm')}}">
                                <span data-key="t-chat">Cài đặt MLM</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1.5 12h11a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-11a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1"/>
                                <path d="M7 5.714a1.029 1.029 0 1 0 0-2.058a1.029 1.029 0 0 0 0 2.058"/>
                                <path d="M8.8 7.514a1.8 1.8 0 1 0-3.6 0v.772h.771l.257 2.058h1.544l.257-2.058H8.8z"/>
                            </g>
                        </svg>
                        <span data-key="t-apps">Quản lý gói tháng</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.package')}}">
                                <span data-key="t-chat">Gói tháng</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
