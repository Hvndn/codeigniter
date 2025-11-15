<div class="container">
<div class="card">
	<div class="card-header">
		Thêm Brand
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

		<form action="<?php echo base_url('brand/store')?> " method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputEmail1">Tên Brand</label>
				<input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				<?php echo '<span class="text text-danger">'. form_error('title').'</span>'?>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Slug</label>
				<input type="text" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				<?php echo '<span class="text text-danger">'. form_error('slug').'</span>'?>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Mô Tả Brand</label>
				<input type="text" name="description" class="form-control"  id="exampleInputPassword1" >
				<?php echo '<span class="text text-danger">'.form_error('description').' </span> '?>

			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Hình Ảnh</label>
				<input type="file" name="image"   class="form-control-file"  id="exampleInputPassword1" >
				<small><?php if (isset($error)){echo $error;}?></small>
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
			<a class="btn btn-success" href="<?php echo base_url('brand/list')?>">Danh Sách Brand</a>


		</form>
	</div>
</div>
</div>

