<div class="container">
	<div class="card">
		<div class="card-header">
			Quản Lý Danh Mục
		</div>
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
		<div class="card-body">
			<a href="<?php echo base_url('category/create')?>" class="btn btn-primary">Thêm Danh Mục</a>

			<table class="table table-striped">
				<thead>
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Tên Danh Mục </th>
					<th scope="col">Mô Tả</th>
					<th scope="col">Hình Ảnh</th>
					<th scope="col">Trạng Thái</th>
					<th scope="col">Quản Lý</th>

				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($category as $key =>$category) {

					?>
					<tr>
						<th scope="row"><?php echo $key?></th>
						<td><?php echo $category->title?></td>
						<td><?php echo $category->description?></td>
						<td>
							<img src="	<?php echo base_url('uploads/category/'.$category->image) ?>" width = "150" height = "150">
						</td>
						<td>
							<?php
							if ($category->status ==1){
								echo 'Kích Hoạt';
							}
							else{
								echo 'Không Kích Hoạt';
							}
							?>
						</td>
						<td>
							<a href="<?php echo base_url('category/edit/'.$category->id) ?> " class="btn btn-warning">Sửa</a>

							<a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="<?php echo base_url('category/delete/'.$category->id) ?>" class="btn btn-danger">Xóa</a>
						</td>
					</tr>
					<?php
				}
				?>

				</tbody>
			</table>
		</div>
	</div>
