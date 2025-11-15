<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('IndexController') ?>">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <h4>Danh Sách Sản Phẩm Thanh Toán</h4>
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


                    </tbody>
                </table>
            <?php  } else {
                echo '<span class="text text-danger">Vui Lòng Thêm Sản Phẩm Vào Giỏ</span> ';
            }
            ?>

        </div>
        <section><!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2>Điền Thông Tin của Bạn Để Thanh Toán</h2>
                            <form onsubmit="return confirm ('Xác Nhận Đặt Hàng')" action="POST">
                                <label for="">Tên</label>
                                <input type="text" name="ten" placeholder="Tên">
                                <label for="">Địa Chỉ</label>
                                <input type="text" name="diachi" placeholder="Địa Chi">
                                <label for="">Số Điện Thoại</label>
                                <input type="text" name="sdt" placeholder="SĐT">
                                <label for="">Hình Thức Thanh Toán</label>
                                <select name="hinhthucthanhtoan" id="">
                                    <option value="">Bằng COD</option>
                                    <option value="">Bằng Ngân Hàng</option>
                                </select>

                                <button type="submit" class="btn btn-default">Xác Nhận Thanh Toán</button>
                            </form>

                        </div><!--/login form-->
                    </div>

                </div>
            </div>
        </section><!--/form-->


    </div>
</section>