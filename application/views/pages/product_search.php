<div class="container-fluid search-results-wrapper" style="padding: 0 80px;">
    <h2>Kết quả tìm kiếm cho: "<?php echo $this->input->get('keyword'); ?>"</h2>
    <div class="features_items">
        <?php if (!empty($products)) {
            $count = 0;
            foreach ($products as $pro):
                if ($count % 4 == 0) echo '<div class="row">';
        ?>
        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="<?php echo base_url('product/' . $pro['slug']); ?>">
                            <img src="<?php echo base_url('uploads/product/' . $pro['image']); ?>"
                                alt="<?php echo $pro['title']; ?>" class="product-img" />
                        </a>
                        <h2><?php echo number_format((float)$pro['price'], 0, ',', '.') ?> VND</h2>
                        <p><?php echo $pro['title']; ?></p>



                        <form action="<?php echo base_url('add-to-cart'); ?>" method="POST" style="display:inline;">
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
                if ($count % 4 == 0) echo '</div>';
            endforeach;
            if ($count % 4 != 0) echo '</div>';
        } else { ?>
        <p>Không tìm thấy sản phẩm nào.</p>
        <?php } ?>
    </div>
</div>
<style>
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