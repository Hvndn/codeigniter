<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ADMIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard') ?>">Trang Chủ <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Brand
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url('brand/create') ?>">Thêm Brand</a>
                    <a class="dropdown-item" href="<?php echo base_url('brand/list') ?>">Danh Sách Brand</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url('category/create') ?>">Thêm Danh Mục</a>
                    <a class="dropdown-item" href="<?php echo base_url('category/list') ?>">Danh Sách Danh Mục</a>

                </div>
            </li>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Sản Phẩm
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url('product/create') ?>">Thêm Sản Phẩm</a>
                    <a class="dropdown-item" href="<?php echo base_url('product/list') ?>">Danh Sách Sản Phẩm</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCustomer" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Khách Hàng
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownCustomer">
                    <a class="dropdown-item" href="<?php echo base_url('admin/customers') ?>">Danh Sách Khách Hàng</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownChat" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Lịch Sử ChatBot
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownChat">
                    <a class="dropdown-item" href="<?php echo base_url('admin/chat-history') ?>">Xem Lịch Sử ChatBot</a>
                </div>
            </li>



            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('logout') ?>">Đăng Xuất <span
                        class="sr-only">(current)</span></a>
            </li>

        </ul>

    </div>
</nav>