<div class="container">
	<div class="card">
		<div class="card-header">
			Sửa Sản Phẩm
		</div>
		<div class="card-body">
			<?php
			if ($this->session->flashdata('success')) {
				echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
			} elseif ($this->session->flashdata('error')) {
				echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
			}
			?>

			<form action="<?php echo base_url('product/update/' . $product->id) ?>" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="exampleInputEmail1">Tên Sản Phẩm</label>
					<input type="text" name="title" value="<?php echo isset($product->title) ? $product->title : ''; ?>" class="form-control" id="exampleInputTitle" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('title') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Giá</label>
					<input type="text" name="price" value="<?php echo isset($product->price) ? $product->price : ''; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('price') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputQuantity">Số Lượng</label>
					<input type="text" name="quantity" value="<?php echo isset($product->quantity) ? $product->quantity : ''; ?>" class="form-control" id="exampleInputQuantity" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('quantity') . '</span>' ?>
				</div>

				<div class="form-group">
					<label for="exampleInputSlug">Slug</label>
					<input type="text" name="slug" value="<?php echo isset($product->slug) ? $product->slug : ''; ?>" class="form-control" id="exampleInputSlug" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('slug') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputDescription">Mô Tả Sản Phẩm</label>
					<input type="text" name="description" value="<?php echo isset($product->description) ? $product->description : ''; ?>" class="form-control" id="exampleInputDescription" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('description') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Hình Ảnh</label>
					<input type="file" name="image" class="form-control-file" id="exampleInputPassword1">
					<?php if (!empty($product->image)): ?>
						<img src="<?php echo base_url('uploads/product/' . $product->image) ?>" width="150" height="150">
					<?php endif; ?>
					<small><?php if (isset($error)) {
								echo $error;
							} ?></small>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Danh Mục</label>
					<select class="form-control" name="category_id" id="exampleFormControlSelect1">
						<?php foreach ($category as $cate) { ?>
							<option <?php echo $cate->id == $product->category_id ? 'selected' : '' ?> value="<?php echo $cate->id ?>"><?php echo $cate->title ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Thương Hiệu</label>
					<select class="form-control" name="brand_id" id="exampleFormControlSelect1">
						<?php foreach ($brand as $bra) { ?>
							<option <?php echo $bra->id == $product->brand_id ? 'selected' : '' ?> value="<?php echo $bra->id ?>"><?php echo $bra->title ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Trạng Thái</label>
					<select class="form-control" name="status" id="exampleFormControlSelect1">
						<option value="1" <?php echo $product->status == 1 ? 'selected' : '' ?>>Kích Hoạt</option>
						<option value="0" <?php echo $product->status == 0 ? 'selected' : '' ?>>Không Kích hoạt</option>
					</select>
				</div>

				<button type="submit" class="btn btn-primary">Cập Nhật</button>
				<a href="<?php echo base_url('product/create') ?>" class="btn btn-success">Thêm Sản Phẩm</a>
				<a class="btn btn-info" href="<?php echo base_url('product/list') ?>">Danh Sách Sản Phẩm</a>
			</form>
		</div>
	</div>
</div>