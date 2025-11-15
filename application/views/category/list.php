<div class="container">
    <div class="card">
        <div class="card-header">
            Quản Lý Danh Mục
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <div class="card-body">
            <a href="<?= base_url('category/create') ?>" class="btn btn-primary">Thêm Danh Mục</a>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên Danh Mục</th>
                        <th scope="col">Nhóm Cha</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Quản Lý</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($category as $key => $c): ?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>

                            <!-- Tên danh mục -->
                            <td><?= $c['title'] ?></td>

                            <!-- Nhóm cha -->
                            <td><?= !empty($c['parent_title']) ? $c['parent_title'] : 'Nhóm chính' ?></td>

                            <!-- Mô tả -->
                            <td><?= $c['description'] ?></td>

                            <!-- Hình ảnh -->
                            <td>
                                <img src="<?= base_url('uploads/category/' . $c['image']) ?>" width="150" height="150">
                            </td>

                            <!-- Trạng thái -->
                            <td>
                                <?= ($c['status'] == 1) ? 'Kích Hoạt' : 'Không Kích Hoạt' ?>
                            </td>

                            <!-- Quản lý -->
                            <td>
                                <a href="<?= base_url('category/edit/' . $c['id']) ?>" class="btn btn-warning">Sửa</a>
                                <a onclick="return confirm('Bạn có chắc chắn xóa không ?')"
                                    href="<?= base_url('category/delete/' . $c['id']) ?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>