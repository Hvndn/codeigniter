<div class="container mt-4">
    <h3 class="mb-4">📜 Danh sách khách hàng đã chat</h3>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Xem lịch sử</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['name'] ?></td>
                    <td><?= $u['email'] ?></td>

                    <td>
                        <a href="<?= base_url('admin/chat-history/' . $u['id']); ?>" class="btn btn-primary btn-sm">
                            Xem lịch sử chat
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>