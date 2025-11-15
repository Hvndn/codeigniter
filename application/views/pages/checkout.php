<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs" style="margin-bottom:15px; padding:0 100px;">
            <ol class="breadcrumb" style="background:none; padding:0; margin:0;">
                <li><a href="<?php echo base_url('IndexController') ?>">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info" style="padding:0 100px;">
            <h4>Danh Sách Sản Phẩm Thanh Toán</h4>
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
                            <td class="text-right"><?php echo number_format($items['price'], 0, ',', '.') ?> VND
                            </td>
                            <td class="text-center">
                                <form action="<?php echo base_url('update-cart-item') ?>" method="POST">
                                    <input type="hidden" name="rowid" value="<?php echo $items['rowid'] ?>">
                                    <input type="number" name="quantity" value="<?php echo $items['qty'] ?>" min="1"
                                        class="qty_input">
                                </form>
                            </td>
                            <td class="text-right"><?php echo number_format($subtotal, 0, ',', '.') ?> VND</td>
                            <td class="text-center">
                                <a href="<?php echo base_url('delete-item/' . $items['rowid']) ?>"
                                    class="delete_item"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="cart_total">
                            <td colspan="3"></td>
                            <td colspan="3" class="text-right">
                                <strong>Tổng Thành Tiền: <?php echo number_format($total, 0, ',', '.') ?>
                                    VND</strong><br>
                                <a href="<?php echo base_url('delete-all-cart') ?>" class="btn btn-danger btn-sm">Xóa
                                    Tất
                                    Cả</a>
                                <a href="<?php echo base_url('checkout') ?>" class="btn btn-success btn-sm">Đặt
                                    Hàng</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } else {
                echo '<span class="text text-danger">Vui Lòng Thêm Sản Phẩm Vào Giỏ</span>';
            } ?>

        </div>
        <section>
            <!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-form">
                            <!--login form-->
                            <h2>Điền Thông Tin của Bạn Để Đặt Hàng</h2>
                            <form action="<?php echo base_url('confirm-checkout') ?>" method="POST" id="checkoutForm">
                                <label for="">Tên</label>
                                <input type="text" name="ten" placeholder="Tên" required>
                                <?php echo form_error('ten'); ?>
                                <label for="">Địa Chỉ</label>
                                <input type="text" name="diachi" placeholder="Địa Chỉ" required>
                                <?php echo form_error('diachi'); ?>
                                <label for="">Số Điện Thoại</label>
                                <input type="text" name="sdt" placeholder="SĐT" required>
                                <?php echo form_error('sdt'); ?>
                                <label for="">Hình Thức Thanh Toán</label>
                                <select name="hinhthucthanhtoan" required>
                                    <option value="cod">Bằng COD</option>
                                    <option value="bank">Bằng Ngân Hàng</option>
                                </select>

                                <!-- Nút mở popup -->
                                <button type="button" class="btn btn-default" id="openConfirm">Xác Nhận Thanh
                                    Toán</button>

                                <!-- Popup xác nhận -->
                                <div id="confirmBox">
                                    <div class="confirm-content">
                                        <h4>Xác Nhận Đặt Hàng</h4>
                                        <p>Bạn có chắc chắn muốn đặt hàng không?</p>
                                        <div class="actions">
                                            <button type="button" id="cancelBtn">Hủy</button>
                                            <button type="submit" id="okBtn">Đồng Ý</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/login form-->
                    </div>
                </div>
            </div>
        </section>
        <!--/form-->
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
        <style>
        /* Ẩn popup ban đầu */
        #confirmBox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        /* Hộp popup */
        .confirm-content {
            background: #fff;
            width: 350px;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            animation: zoomIn 0.3s ease;
        }

        .confirm-content h4 {
            margin-bottom: 15px;
        }

        .confirm-content .actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .confirm-content button {
            padding: 6px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #cancelBtn {
            background: #ccc;
        }

        #okBtn {
            background: #28a745;
            color: #fff;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.7);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        </style>

        <script>
        // mở popup
        document.getElementById('openConfirm').onclick = function() {
            document.getElementById('confirmBox').style.display = 'block';
        };

        // hủy
        document.getElementById('cancelBtn').onclick = function() {
            document.getElementById('confirmBox').style.display = 'none';
        };
        </script>



    </div>
</section>

<!--/form-->
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
<style>
/* Ẩn popup ban đầu */
#confirmBox {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

/* Hộp popup */
.confirm-content {
    background: #fff;
    width: 350px;
    margin: 15% auto;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    animation: zoomIn 0.3s ease;
}

.confirm-content h4 {
    margin-bottom: 15px;
}

.confirm-content .actions {
    margin-top: 20px;
    display: flex;
    justify-content: space-around;
}

.confirm-content button {
    padding: 6px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#cancelBtn {
    background: #ccc;
}

#okBtn {
    background: #28a745;
    color: #fff;
}

@keyframes zoomIn {
    from {
        transform: scale(0.7);
        opacity: 0;
    }

    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

<script>
// mở popup
document.getElementById('openConfirm').onclick = function() {
    document.getElementById('confirmBox').style.display = 'block';
};

// hủy
document.getElementById('cancelBtn').onclick = function() {
    document.getElementById('confirmBox').style.display = 'none';
};
</script>



</div>
</section>