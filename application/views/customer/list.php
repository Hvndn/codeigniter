<div class="container mt-4">
    <h2>Danh sách khách hàng</h2>

    <?php if (!empty($customers)) { ?>
        <table class="table table-bordered table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $index => $customer) { 
                    if ($customer['role'] === 'admin') continue; // ẩn admin
                ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($customer['name']); ?></td>
                        <td><?php echo htmlspecialchars($customer['email']); ?></td>
                        <td>
                            <span class="badge badge-secondary">Customer</span>
                        </td>
                        <td>
                            <?php echo isset($customer['created_at']) ? date('d/m/Y H:i', strtotime($customer['created_at'])) : '-'; ?>
                        </td>
                        <td>
                         <a href="<?php echo base_url('admin/orders/'.$customer['id']); ?>" class="btn btn-primary btn-sm">
                            Xem đơn hàng
                        </a>


                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Hiện tại chưa có khách hàng nào.</p>
    <?php } ?>
</div>
