<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('IndexController') ?>">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <h4>Danh Sách Sản Phẩm Trong Giỏ Hàng</h4>
            <?php
            if ($this->cart->contents()) {
            ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="name">Tên Sản Phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số Lượng</td>
                            <td class="total">Thành Tiền</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $subtotal = 0;
                        $total = 0;
                        foreach ($this->cart->contents() as $items) {
                            $subtotal = $items['qty'] * $items['price'];
                            $total = $total + $subtotal;
                        ?>
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="<?php echo base_url('uploads/product/' . $items['options']['image'])  ?>" width="100" height="100" alt="<?php echo $items['name'] ?>"></a>
                                </td>
                                <td class="cart_description">
                                    <h4 style="margin-right:5px;" s><?php echo $items['name'] ?></h4>

                                </td>
                                <td class="cart_price">
                                    <p><b><?php echo number_format((float)$items['price'], 0, ',', '.') ?> VND</b></p>
                                </td>
                                <td class="cart_quantity">
                                    <form action="<?php echo base_url('update-cart-item') ?>" method="POST">
                                        <div class="cart_quantity_button">
                                            <input type="hidden" value="<?php echo $items['rowid'] ?>" name="rowid">
                                            <input class="cart_quantity_input" type="number" min="1" name="quantity" style="width: 70px;" value="<?php echo $items['qty'] ?>" autocomplete="off" size="2"><br>
                                            <!-- <input type="submit" name="capnhat" class="btn btn-success" value="Cập Nhật"></input> -->
                                        </div>
                                    </form>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"><?php echo number_format($subtotal, 0, ',', '.') ?> VND</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="<?php echo base_url('delete-item/' . $items['rowid']) ?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td colspan="3">
                                <h4>Tổng Thành Tiền</h4>
                                <p class="cart_total_price"><?php echo number_format($total, 0, ',', '.') ?> VND</p>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="<?php echo base_url('delete-all-cart') ?>" class="btn btn-danger">Xóa Tất Cả</a>
                                <a href="<?php echo base_url('checkout') ?>" class="btn btn-success">Đặt Hàng</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            <?php  } else {
                echo '<span class="text text-danger">Vui Lòng Thêm Sản Phẩm Vào Giỏ</span> ';
            }
            ?>

        </div>


    </div>
</section>