<section id="cart_items" style="padding:20px 0; background:#f9f9f9;">
    <!-- Breadcrumb -->
    <div class="breadcrumbs" style="margin-bottom:15px; padding:0 100px;">
        <ol class="breadcrumb" style="background:none; padding:0; margin:0;">
            <li><a href="<?php echo base_url('IndexController') ?>">Home</a></li>
            <li class="active">Shopping Cart</li>
        </ol>
    </div>

    <!-- Cart Table -->
    <div class="cart_info" style="padding:0 100px;">
        <h4>Danh Sách Sản Phẩm Trong Giỏ Hàng</h4>
        <?php if ($this->cart->contents()) { ?>
            <div class="table-responsive">
                <table class="table table-bordered cart_table" style="margin:0; width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-left">Tên Sản Phẩm</th>
                            <th class="text-right">Giá</th>
                            <th class="text-center">Số Lượng</th>
                            <th class="text-right">Thành Tiền</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($this->cart->contents() as $items) {
                            $subtotal = $items['qty'] * $items['price'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?php echo base_url('uploads/product/' . $items['options']['image']) ?>"
                                        alt="<?php echo $items['name'] ?>" class="cart_img">
                                </td>
                                <td class="product_name"><?php echo $items['name'] ?></td>
                                <td class="text-right"><?php echo number_format($items['price'], 0, ',', '.') ?> VND</td>
                                <td class="text-center">
                                    <form action="<?php echo base_url('update-cart-item') ?>" method="POST">
                                        <input type="hidden" name="rowid" value="<?php echo $items['rowid'] ?>">
                                        <input type="number" name="quantity" value="<?php echo $items['qty'] ?>" min="1"
                                            class="qty_input">
                                    </form>
                                </td>
                                <td class="text-right"><?php echo number_format($subtotal, 0, ',', '.') ?> VND</td>
                                <td class="text-center">
                                    <a href="<?php echo base_url('delete-item/' . $items['rowid']) ?>" class="delete_item"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr class="cart_total">
                            <td colspan="3"></td>
                            <td colspan="3" class="text-right">
                                <strong>Tổng Thành Tiền: <?php echo number_format($total, 0, ',', '.') ?> VND</strong><br>
                                <a href="<?php echo base_url('delete-all-cart') ?>" class="btn btn-danger btn-sm">Xóa Tất
                                    Cả</a>
                                <a href="<?php echo base_url('checkout') ?>" class="btn btn-success btn-sm">Đặt Hàng</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } else {
            echo '<span class="text text-danger">Vui Lòng Thêm Sản Phẩm Vào Giỏ</span>';
        } ?>
    </div>
</section>

<style>
    /* Cart section padding 2 bên 50px */
    #cart_items {
        padding: 20px 0;
    }

    .cart_info {
        padding: 0 100px;
    }

    /* Breadcrumb trùng bảng */
    .breadcrumb {
        padding: 0;
        background: none;
        margin-bottom: 15px;
    }

    /* Xoá tam giác màu cam bên trái breadcrumb */
    .breadcrumb li.active::before {
        content: none !important;
        /* bỏ ký tự/mũi tên */
        border: none !important;
        /* bỏ border tam giác */
    }


    /* Table */
    .cart_table th,
    .cart_table td {
        padding: 8px 6px;
        vertical-align: middle;
    }

    .cart_table th {
        background: #eee;
    }

    .cart_img {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }

    .product_name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .qty_input {
        width: 45px;
        text-align: center;
    }

    .delete_item {
        color: red;
    }

    .cart_total td {
        padding: 8px 6px;
    }

    /* Responsive */
    @media (max-width:768px) {
        .cart_info {
            padding: 0 15px;
        }

        .cart_table th,
        .cart_table td {
            font-size: 12px;
            padding: 5px 4px;
        }

        .cart_img {
            width: 45px;
            height: 45px;
        }

        .product_name {
            white-space: normal;
        }
    }

    .table-responsive {
        font-weight: bold;
    }
</style>