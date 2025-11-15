<section>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="features_items">
                    <h2 class="title text-center" style="margin-top: 10px;font-size:20px">Danh Mục:
                        <?php echo $title; ?></h2>

                    <?php if (!empty($category_product)) {
                        $count = 0;
                        foreach ($category_product as $pro) {
                            if ($count % 4 == 0) echo '<div class="row justify-content-center">'; // mở row mỗi 4 sản phẩm
                    ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="<?php echo base_url('product/' . $pro['slug']); ?>">

                                                <img src="<?php echo base_url('uploads/product/' . $pro['image']); ?>"
                                                    alt="<?php echo $pro['title']; ?>" class="product-img" />
                                            </a>
                                            <h2><?php echo number_format((float)$pro['price'], 0, ',', '.'); ?> VND</h2>
                                            <p><?php echo $pro['title']; ?></p>


                                            <!-- Add to cart theo slug -->
                                            <form action="<?php echo base_url('add-to-cart'); ?>" method="POST"
                                                style="display:inline;">
                                                <input type="hidden" name="product_slug" value="<?php echo $pro['slug']; ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-default add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to cart
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                            $count++;
                            if ($count % 4 == 0) echo '</div>'; // đóng row mỗi 4 sản phẩm
                        }
                        if ($count % 4 != 0) echo '</div>'; // đóng row cuối nếu chưa đóng
                    } else {
                        echo '<p class="text-center">Danh mục này chưa có sản phẩm nào.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ===== Tạo khoảng trắng 2 bên vùng sản phẩm ===== */
    .features_items {
        padding-left: 80px !important;
        padding-right: 80px !important;
    }

    /* ===== Ảnh sản phẩm tự động căn chỉnh ===== */
    .productinfo {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Ảnh co giãn tự động, không bị méo hoặc vỡ */
    .productinfo .product-img {
        width: 100%;
        max-width: 280px;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    /* Hover phóng nhẹ */
    .productinfo a:hover .product-img {
        transform: scale(1.05);
    }

    /* Giảm khoảng cách dọc */
    .product-image-wrapper {
        margin-bottom: 25px !important;
    }

    /* Nút đặt hàng */
    .btn.add-to-cart {
        margin-top: 10px;
        padding: 8px 18px;
        font-weight: bold;
        border-radius: 6px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn.add-to-cart:hover {
        background-color: #218838 !important;
        color: #fff !important;
        transform: scale(1.03);
    }
</style>