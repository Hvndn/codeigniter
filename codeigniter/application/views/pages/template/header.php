<?php
defined('BASEPATH')  or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link type="image/x-icon" href="https://img.pikbest.com/png-images/football-icon_5881725.png!sw800" rel="shortcut icon" />
    <title>Shop Bóng Đá</title>
    <link href="<?php echo base_url('frontend/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/prettyPhoto.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/price-range.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/main.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('frontend/css/responsive.css') ?>" rel="stylesheet">
    <!-- <link rel="shortcut icon" href="frontend/images/ico/favicon.ico"> -->
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
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
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="<?php echo base_url('IndexController') ?>"><img src="<?php echo base_url('frontend/images/home/ShopBongDa2.png') ?>" alt="Logo" /></a>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php
                                if ($this->session->userdata('LoggedInCustomer')) {
                                ?>
                                    <li><a href="#"><i class="fa fa-user"></i> Xin Chào: <?php echo $this->session->userdata('LoggedInCustomer')['username'] ?></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                    <li><a href="<?php echo base_url('checkout') ?>"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
                                    <li><a href="<?php echo base_url('gio-hang') ?>"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>
                                    <li><a href="<?php echo base_url('dang-xuat') ?>"><i class="fa fa-lock"></i> Đăng Xuất</a></li>


                                <?php
                                } else {

                                ?>
                                    <li><a href="<?php echo base_url('dang-nhap') ?>"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="<?php echo base_url('IndexController') ?>" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php foreach ($category as $cate) { ?>
                                            <li><a href="<?php echo base_url('danh-muc/' . $cate['id']) ?>"><?php echo $cate['title'] ?></a></li>
                                        <?php } ?>


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
                            <input type="text" placeholder="Search" />
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
        <div id="bannerCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bannerCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#bannerCarousel" data-slide-to="1"></li>
    <li data-target="#bannerCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="/frontend/images/banner/banner1.png" alt="Banner 1" class="img-responsive">
    </div>
    <div class="item">
      <img src="/frontend/images/banner/banner2.png" alt="Banner 2" class="img-responsive">
    </div>
    <div class="item">
      <img src="/frontend/images/banner/banner3.png" alt="Banner 3" class="img-responsive">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#bannerCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#bannerCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

    </header><!--/header-->
    <style>
        #bannerCarousel .item img {
  width: 100%;
  height: 400px; /* chỉnh tùy theo chiều cao bạn muốn */
  object-fit: cover; /* cắt cho vừa khung mà không méo hình */
}

        .carousel-inner img {
  width: 100%;
  height: 400px; /* hoặc auto nếu muốn giữ tỉ lệ */
  object-fit: cover;
  border-radius: 10px;
}

.carousel-control.left,
.carousel-control.right {
  background-image: none !important;
}

.carousel-control .glyphicon {
  color: orange;
  font-size: 30px;
}

.carousel-indicators li {
  background-color: #ff6600;
}

    </style>
    <script src="<?php echo base_url('frontend/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('frontend/js/bootstrap.min.js'); ?>"></script>
<script>
    $('#bannerCarousel').carousel({
  interval: 3000, // 3 giây tự động đổi
  pause: "hover" // dừng khi rê chuột vào
});

</script>
