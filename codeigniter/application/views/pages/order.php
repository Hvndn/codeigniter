<div class="container">
    <h2>Danh sách đơn hàng của bạn</h2>

    <?php if (!empty($orders)) { ?>
        <?php foreach ($orders as $order) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Đơn hàng: <?php echo $order['order_code']; ?></strong> 
                    | Ngày đặt: <?php echo $order['created_at']; ?> 
                    | Trạng thái: 
                    <?php 
                        switch ($order['status']) {
                            case 0: echo '<span class="label label-warning">Chờ xử lý</span>'; break;
                            case 1: echo '<span class="label label-info">Đang giao</span>'; break;
                            case 2: echo '<span class="label label-success">Hoàn thành</span>'; break;
                            case 3: echo '<span class="label label-danger">Đã hủy</span>'; break;
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total = 0;
                                foreach ($order['items'] as $item) { 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                            ?>
                                <tr>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" class="text-right"><b>Tổng cộng:</b></td>
                                <td><b><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Bạn chưa có đơn hàng nào.</p>
    <?php } ?>
</div>
