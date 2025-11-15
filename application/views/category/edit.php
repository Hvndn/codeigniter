<div class="container">
    <div class="card">
        <div class="card-header">
            Sửa Danh Mục
        </div>
        <div class="card-body">

            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
            <?php } elseif ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
            <?php } ?>

            <form action="<?php echo base_url('category/update/' . $category->id) ?>" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Tên Danh Mục</label>
                    <input type="text" name="title" value="<?php echo $category->title ?>" class="form-control">
                    <?php echo '<span class="text text-danger">' . form_error('title') . '</span>' ?>
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" value="<?php echo $category->slug ?>" class="form-control">
                    <?php echo '<span class="text text-danger">' . form_error('slug') . '</span>' ?>
                </div>

                <div class="form-group">
                    <label for="description">Mô Tả Danh Mục</label>
                    <input type="text" name="description" value="<?php echo $category->description ?>" class="form-control">
                    <?php echo '<span class="text text-danger">' . form_error('description') . ' </span>' ?>
                </div>

                <div class="form-group">
                    <label for="image">Hình Ảnh</label>
                    <input type="file" name="image" class="form-control-file">
                    <?php if ($category->image) { ?>
                        <img src="<?php echo base_url('uploads/category/' . $category->image) ?>" width="150" height="150">
                    <?php } ?>
                    <small><?php if (isset($error)) { echo $error; } ?></small>
                </div>

                <!-- Chọn nhóm cha -->
                <div class="form-group">
                    <label>Nhóm cha</label>
                    <select name="parent_id" class="form-control">
                        <option value="">--Nhóm chính--</option>
                        <?php foreach($groups as $g) { ?>
                            <option value="<?php echo $g['id'] ?>" <?php echo ($category->parent_id == $g['id']) ? 'selected' : '' ?>>
                                <?php echo $g['title'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="status">
                        <option value="1" <?php echo ($category->status == 1) ? 'selected' : '' ?>>Kích Hoạt</option>
                        <option value="0" <?php echo ($category->status == 0) ? 'selected' : '' ?>>Không Kích hoạt</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="<?php echo base_url('category/create') ?>" class="btn btn-success">Thêm Danh Mục</a>
                <a href="<?php echo base_url('category/list') ?>" class="btn btn-info">Danh Sách Danh Mục</a>

            </form>
        </div>
    </div>
</div>
