<div class="container">
    <div class="card">
        <div class="card-header">
            Thêm Danh Mục
        </div>
        <div class="card-body">

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php elseif($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <form action="<?php echo base_url('category/store'); ?>" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Tên Danh Mục</label>
                    <input type="text" name="title" class="form-control" id="title">
                    <?php echo '<span class="text text-danger">'. form_error('title').'</span>'; ?>
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug">
                    <?php echo '<span class="text text-danger">'. form_error('slug').'</span>'; ?>
                </div>

                <div class="form-group">
                    <label for="description">Mô Tả Danh Mục</label>
                    <input type="text" name="description" class="form-control" id="description">
                    <?php echo '<span class="text text-danger">'.form_error('description').'</span>'; ?>
                </div>

                <div class="form-group">
                    <label for="parent_id">Nhóm danh mục</label>
                    <select name="parent_id" class="form-control" id="parent_id">
                        <option value="">--Nhóm chính--</option>
                        <?php foreach($groups as $g): ?>
                            <option value="<?php echo $g['id']; ?>"><?php echo $g['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Hình Ảnh</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                    <small><?php if (isset($error)) echo $error; ?></small>
                </div>

                <div class="form-group">
                    <label for="status">Trạng Thái</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1">Kích Hoạt</option>
                        <option value="0">Không Kích hoạt</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm Vào</button>
                <a class="btn btn-success" href="<?php echo base_url('category/list'); ?>">Danh Sách Danh Mục</a>

            </form>
        </div>
    </div>
</div>
