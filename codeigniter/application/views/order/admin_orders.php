<div class="container mt-4" style="max-width: 800px;"> <!-- giới hạn bề ngang -->

    <a href="<?php echo base_url('admin/customers'); ?>" 
   class="btn btn-outline-secondary btn-sm mb-3">
   <i class="fas fa-arrow-left"></i> Quay lại danh sách
</a>


    <h5 class="mb-2">Đơn Hàng Của: <?php echo htmlspecialchars($customer['name']); ?></h5>
    <p class="mb-2"><small>Email: <?php echo htmlspecialchars($customer['email']); ?> | Role: <?php echo htmlspecialchars($customer['role']); ?></small></p>

    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-2 shadow-sm" style="font-size: 0.9rem;">
                <div class="card-header bg-info text-white py-1">
                    <strong>Mã Đơn:</strong> <?php echo $order['order_code']; ?><br>
                    <strong>Trạng thái:</strong> 
                    <?php
                        switch ($order['status']) {
                            case 0: echo '<span class="badge badge-warning">Chờ xử lý</span>'; break;
                            case 1: echo '<span class="badge badge-primary">Đang giao</span>'; break;
                            case 2: echo '<span class="badge badge-success">Hoàn thành</span>'; break;
                            case 3: echo '<span class="badge badge-danger">Đã hủy</span>'; break;
                        }
                    ?><br>
                    <strong>Ngày đặt:</strong> <?php echo isset($order['created_at']) ? $order['created_at'] : ''; ?>
                </div>
                <div class="card-body py-2 px-2">
                    <p class="mb-1"><small>
                        <strong>Giao hàng:</strong> <?php echo $order['name']; ?>, <?php echo $order['phone']; ?><br>
                        <strong>Email:</strong> <?php echo $order['email']; ?><br>
                        <strong>Địa chỉ:</strong> <?php echo $order['address']; ?><br>
                        <strong>Phương thức:</strong> <?php echo $order['method']; ?>
                    </small></p>

                    <table class="table table-sm table-bordered mb-1" style="font-size: 0.85rem;">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>SL</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            foreach ($order['items'] as $item):
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo number_format($item['price'],0,',','.'); ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($subtotal,0,',','.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-right"><b>Tổng cộng:</b></td>
                                <td><b><?php echo number_format($total,0,',','.'); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Khách hàng này chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>
