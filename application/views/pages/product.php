<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <?php if (!empty($product_detail)) { ?>
                <div class="product-details">

                    <!-- FORM ADD TO CART: SỬ DỤNG SLUG -->
                    <form action="<?php echo base_url('add-to-cart'); ?>" method="POST">
                        <input type="hidden" name="product_slug" value="<?php echo $product_detail['slug']; ?>">

                        <div class="row">

                            <!-- Ảnh sản phẩm -->
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="<?php echo base_url('uploads/product/' . $product_detail['image']); ?>"
                                        alt="<?php echo $product_detail['title']; ?>" />
                                </div>
                            </div>

                            <!-- Thông tin sản phẩm -->
                            <div class="col-sm-7">
                                <div class="product-information">

                                    <img src="<?php echo base_url('images/product-details/new.jpg'); ?>"
                                        class="newarrival" alt="" />

                                    <h2><?php echo $product_detail['title']; ?></h2>

                                    <img src="<?php echo base_url('images/product-details/rating.png'); ?>" alt="" />

                                    <span>
                                        <span><?php echo number_format($product_detail['price'], 0, ',', '.'); ?>
                                            VND</span>

                                        <label>Số lượng còn: <?php echo $product_detail['quantity']; ?></label><br>

                                        <label>Nhập số lượng: </label>
                                        <input type="number" min="1" value="1" name="quantity" />

                                        <button type="submit" class="btn btn-default cart">
                                            <i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ Hàng
                                        </button>
                                    </span>

                                    <p><b>Tình Trạng:</b> Mới</p>
                                    <p><b>Danh Mục:</b> <?php echo $product_detail['tendanhmuc']; ?></p>
                                    <p><b>Thương Hiệu:</b> <?php echo $product_detail['tenthuonghieu']; ?></p>

                                    <a href="">
                                        <img src="<?php echo base_url('images/product-details/share.png'); ?>"
                                            class="share img-responsive" alt="" />
                                    </a>

                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- END FORM -->

                </div>
                <?php } else { ?>
                <p>Không tìm thấy sản phẩm.</p>
                <?php } ?>
            </div>
        </div>

        <!-- Tab chi tiết sản phẩm -->
        <div class="category-tab shop-details-tab">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                    <li><a href="#tag" data-toggle="tab">Tag</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                </ul>
            </div>

            <div class="tab-content">
                <!-- Nội dung tab giữ nguyên -->
            </div>
        </div>

    </div>
</section>