<section id="order_items" style="padding:20px 0; background:#f9f9f9;">
    <div class="container-fluid" style="padding:0 50px;">
        <h2>Danh sách đơn hàng của bạn</h2>

        <?php if (!empty($orders)) { ?>
        <?php foreach ($orders as $order) { ?>
        <div class="panel panel-default"
            style="margin-bottom:20px; border-radius:6px; background:#fff; border:1px solid #ddd;">
            <div class="panel-heading" style="padding:10px 15px; font-weight:bold;">
                <strong>Đơn hàng: <?php echo $order['order_code']; ?></strong>
                | Ngày đặt: <?php echo $order['created_at']; ?>
                | Trạng thái:
                <?php
                        switch ($order['status']) {
                            case 0:
                                echo '<span class="label label-warning">Chờ xử lý</span>';
                                break;
                            case 1:
                                echo '<span class="label label-info">Đang giao</span>';
                                break;
                            case 2:
                                echo '<span class="label label-success">Hoàn thành</span>';
                                break;
                            case 3:
                                echo '<span class="label label-danger">Đã hủy</span>';
                                break;
                        }
                        ?>
            </div>

            <div class="panel-body">
                <h4>Thông tin giao hàng</h4>
                <p><b>Tên:</b> <?php echo $order['name']; ?></p>
                <p><b>SĐT:</b> <?php echo $order['phone']; ?></p>
                <p><b>Địa chỉ:</b> <?php echo $order['address']; ?></p>
                <p><b>Email:</b> <?php echo $order['email']; ?></p>
                <p><b>Phương thức:</b> <?php echo $order['method']; ?></p>

                <h4>Chi tiết sản phẩm</h4>
                <div class="table-responsive">
                    <table class="table table-bordered order_table" style="margin:0; width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center">Hình ảnh</th>
                                <th class="text-left">Tên Sản Phẩm</th>
                                <th class="text-right">Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $total = 0;
                                    foreach ($order['items'] as $item) {
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                        $image = isset($item['image']) && $item['image'] ? $item['image'] : 'default.png';
                                    ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?php echo base_url('uploads/product/' . $image); ?>"
                                        alt="<?php echo $item['title']; ?>"
                                        style="width:60px;height:60px;object-fit:cover;">
                                </td>
                                <td class="product_name"><?php echo $item['title']; ?></td>
                                <td class="text-right"><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ
                                </td>
                                <td class="text-center"><?php echo $item['quantity']; ?></td>
                                <td class="text-right"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right"><b>Tổng cộng:</b></td>
                                <td class="text-right"><b><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } else { ?>
        <p>Bạn chưa có đơn hàng nào.</p>
        <?php } ?>
    </div>
</section>