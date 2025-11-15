<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        <?php foreach ($category as $cate) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="<?php echo base_url('danh-muc/' . $cate['id']) ?>"><?php echo $cate['title'] ?></a>
                                    </h4>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Thương Hiệu</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <?php foreach ($brand as $bra) { ?>
                                    <li><a href="<?php echo base_url('thuong-hieu/' . $bra['id']) ?>"><?php echo $bra['title'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Khoảng giá</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="100" data-slider-max="2000" data-slider-step="100" data-slider-value="[500,1500]" id="sl2"><br />
                            <b class="pull-left">$100</b> <b class="pull-right">$2000</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="<?php echo base_url('frontend/images/home/shipping.jpg') ?>" alt="Shipping" />

                    </div><!--/shipping-->
                </div>
            </div>
            <form action="<?php echo base_url('add-to-cart') ?>" method="POST"></form>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Sản Phẩm Nổi Bật</h2>
                    <?php
                    foreach ($product as  $key => $pro) {
                    ?>

                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img style="width:150px;" src="<?php echo base_url('uploads/product/' . $pro['image']) ?>" alt="<?php echo $pro['title'] ?>" />
                                        <h2><?php echo number_format((float)$pro['price'], 0, ',', '.') ?> VND</h2>
                                        <p><?php echo $pro['title'] ?></p>
                                        <a href="<?php echo base_url('san-pham/' . $pro['id']) ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Chi tiết</a>
                                        <button type="submit" class="btn btn-fefault cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Thêm Vào Giỏ Hàng
                                    </div>

                                </div>
                                <div class="choose">
                                    <!-- <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div><!--features_items-->





            </div>

        </div>
    </div>
</section>