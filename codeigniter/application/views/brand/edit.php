<div class="container">
	<div class="card">
		<div class="card-header">
			Sửa Thương Hiệu
		</div>
		<div class="card-body">

			<?php
			if($this->session->flashdata('success')){
				?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('success')?></div>
				<?php
			}
			elseif($this->session->flashdata('error')){


				?>
				<div class="alert alert-danger"><?php echo $this->session->flashdata('error')?></div>
				<?php
			}

			?>

			<form action="<?php echo base_url('brand/update/'.$brand->id)?> " method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="exampleInputEmail1">Tên Thương Hiệu</label>
					<input type="text" name="title" value="<?php echo $brand->title ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">'. form_error('title').'</span>'?>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Slug</label>
					<input type="text" name="slug" value="<?php echo $brand->slug ?>" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp">
					<?php echo '<span class="text text-danger">'. form_error('slug').'</span>'?>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
					<input type="text" name="description" value="<?php echo $brand->description ?>" class="form-control"  id="exampleInputPassword1" >
					<?php echo '<span class="text text-danger">'.form_error('description').' </span> '?>

				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Hình Ảnh</label>
					<input type="file" name="image"   class="form-control-file"  id="exampleInputPassword1" >
					<img src="	<?php echo base_url('uploads/brand/'.$brand->image) ?>" width = "150" height = "150">
					<small><?php if (isset($error)){echo $error;}?></small>
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="exampleFormControlSelect1">Trạng Thái</label>
						<select class="form-control" name="status" id="exampleFormControlSelect1">
							<?php
							if ($brand->status ==1) {
								?>

								<option selected value="1">Kích Hoạt</option>
								<option value="0">Không Kích hoạt</option>
								<?php
							}else{
								?>

							<option value="1">Kích Hoạt</option>
							<option  selected value="0">Không Kích hoạt</option>
							<?php
							}
							?>

						</select>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Cập Nhật</button>
				<a href="<?php echo base_url('brand/create')?>" class="btn btn-success">Thêm Brand</a>

				<a class="btn btn-info" href="<?php echo base_url('brand/list')?>">Danh Sách Thương Hiệu</a>


			</form>
		</div>
	</div>
</div>

