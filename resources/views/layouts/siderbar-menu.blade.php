<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>
            <li>
                <a href="https://quanlycongviec.site/admin">
                <i class="fa fa-home"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <li class="menu-title mt-2" data-key="t-components">Quản lý</li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="shopping-bag"></i>
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
                    <i data-feather="shopping-bag"></i>
                    <span data-key="t-apps">Quản lý Danh Mục</span>
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
                    <i data-feather="shopping-bag"></i>
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
                    <i data-feather="shopping-bag"></i>
                    <span data-key="t-apps">Quản lý Đội Nhóm</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="https://quanlycongviec.site/admin/project/add">
                            <span data-key="t-calendar">Thêm mới</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://quanlycongviec.site/admin/project/list">
                            <span data-key="t-chat">Danh sách</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
