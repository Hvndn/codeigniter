<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link type="image/x-icon" href="https://img.pikbest.com/png-images/football-icon_5881725.png!sw800"
        rel="shortcut icon" />
    <title>Shop Bóng Đá</title>

    <!-- CSS -->
    <link href="<?php echo base_url('frontend/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/prettyPhoto.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/price-range.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/main.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/responsive.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- HEADER -->
    <header id="header">
        <!-- header_top -->
        <div class="header_top">
            <div class="container-fluid header-wrapper">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header-middle -->
        <div class="header-middle">
            <div class="container-fluid header-wrapper">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="<?php echo base_url('trang-chu') ?>">
                                <img src="<?php echo base_url('frontend/images/home/ShopBongDa2.png') ?>" alt="Logo" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php if ($this->session->userdata('LoggedInCustomer')) { ?>
                                    <li><a href="<?php echo base_url('don-hang') ?>"><i class="fa fa-user"></i> Xin Chào:
                                            <?php echo $this->session->userdata('LoggedInCustomer')['username'] ?></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                    <li><a href="<?php echo base_url('checkout') ?>"><i class="fa fa-crosshairs"></i> Thanh
                                            Toán</a></li>
                                    <li><a href="<?php echo base_url('gio-hang') ?>"><i class="fa fa-shopping-cart"></i> Giỏ
                                            Hàng</a></li>
                                    <li><a href="<?php echo base_url('dang-xuat') ?>"><i class="fa fa-lock"></i> Đăng
                                            Xuất</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo base_url('dang-nhap') ?>"><i class="fa fa-lock"></i> Đăng
                                            Nhập</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header-bottom -->
        <?php
        $current_uri = $this->uri->segment(1); // Lấy segment đầu tiên của URL
        if (!in_array($current_uri, ['dang-nhap', 'register'])):
            $category = $category ?? []; // đảm bảo biến category tồn tại
        ?>
            <div class="header-bottom">
                <div class="container-fluid header-wrapper">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="<?php echo base_url('trang-chu') ?>" class="active">Home</a></li>
                                    <li class="dropdown mega-dropdown">
                                        <a href="#">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu mega-dropdown-menu row">
                                            <?php foreach ($category as $parent) {
                                                if ($parent['parent_id'] == 0) { ?>
                                                    <li class="col-sm-4">
                                                        <h4><?php echo $parent['title']; ?></h4>
                                                        <ul>
                                                            <?php $childFound = false;
                                                            foreach ($category as $child) {
                                                                if ($child['parent_id'] == $parent['id']) {
                                                                    $childFound = true; ?>
                                                                    <li><a
                                                                            href="<?php echo base_url('danh-muc/' . $child['slug']); ?>"><?php echo $child['title']; ?></a>
                                                                    </li>
                                                            <?php }
                                                            } ?>
                                                            <?php if (!$childFound) { ?>
                                                                <li><a href="<?php echo base_url('danh-muc/' . $parent['slug']); ?>">Xem
                                                                        sản phẩm</a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                            <?php }
                                            } ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="blog.html">Blog List</a></li>
                                            <li><a href="blog-single.html">Blog Single</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="contact-us.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <form action="<?php echo base_url('tim-kiem'); ?>" method="GET" class="form-inline">
                                    <input type="text" name="keyword" placeholder="Search" required />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>
    <!-- /HEADER -->

    <!-- JS -->
    <script src="<?php echo base_url('frontend/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('frontend/js/bootstrap.min.js'); ?>"></script>
    <script>
        $('#bannerCarousel').carousel({
            interval: 3000,
        });
    </script>
    <style>
        header#header>.container-fluid {
            padding-left: 50px;
            padding-right: 50px;
        }

        @media (max-width: 768px) {
            header#header>.container-fluid {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        .header-wrapper {
            padding-left: 100px;
            padding-right: 100px;
        }
    </style>