<div class="container mt-4">
    <h3 class="mb-4">
        🧑‍💬 Lịch sử chat của:
        <b><?= $customer['name'] ?></b> (ID: <?= $customer['id'] ?>)
    </h3>

    <a href="<?= base_url('admin/chat-history') ?>" class="btn btn-secondary mb-3">
        ⬅ Quay lại danh sách
    </a>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>User Message</th>
                <th>Bot Response</th>
                <th>Thời Gian</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($chats as $c): ?>
                <tr>
                    <td><?= nl2br($c['user_message']) ?></td>
                    <td><?= nl2br($c['bot_response']) ?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($c['created_at'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>