<div class="container">
	<div class="card">
		<div class="card-header">
			Thêm Sản Phẩm
		</div>
		<div class="card-body">
			<?php
			if ($this->session->flashdata('success')) {
			?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
			<?php
			} elseif ($this->session->flashdata('error')) {


			?>
				<div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
			<?php
			}

			?>

			<form action="<?php echo base_url('product/store') ?> " method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="exampleInputEmail1">Tên Sản Phẩm</label>
					<input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('title') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Giá</label>
					<input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('price') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Số Lượng</label>
					<input type="text" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('quantity') . '</span>' ?>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Slug</label>
					<input type="text" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">' . form_error('slug') . '</span>' ?>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
					<input type="text" name="description" class="form-control" id="exampleInputPassword1">
					<?php echo '<span class="text text-danger">' . form_error('description') . ' </span> ' ?>

				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Hình Ảnh</label>
					<input type="file" name="image" class="form-control-file" id="exampleInputPassword1">
					<small><?php if (isset($error)) {
								echo $error;
							} ?></small>
				</div>

				<div class="form-group">
					<div class="form-group">
						<label for="exampleFormControlSelect1">Category</label>
						<select class="form-control" name="category_id" id="exampleFormControlSelect1">
							<?php foreach ($category as $key => $cate) {

							?>
								<option value="<?php echo $cate->id ?> "><?php echo $cate->title ?></option>
							<?php  } ?>

						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="exampleFormControlSelect1">Brand</label>
						<select class="form-control" name="brand_id" id="exampleFormControlSelect1">
							<?php foreach ($brand as $key => $bra) {

							?>
								<option value="<?php echo $bra->id ?> "><?php echo $bra->title ?></option>
							<?php  } ?>



						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="exampleFormControlSelect1">Trạng Thái</label>
						<select class="form-control" name="status" id="exampleFormControlSelect1">
							<option value="1">Kích Hoạt</option>
							<option value="0">Không Kích hoạt</option>

						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Thêm Vào</button>
				<a class="btn btn-success" href="<?php echo base_url('product/list') ?>">Danh Sách Sản Phẩm</a>


			</form>
		</div>
	</div>
</div>