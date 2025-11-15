<div class="container">
	<div class="card">
		<div class="card-header">
		Quản Lý Brand
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
			<a href="<?php echo base_url('brand/create')?>" class="btn btn-primary">Thêm Brand</a>

			<table class="table table-striped">
				<thead>
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Tên Brand </th>
					<th scope="col">Mô Tả</th>
					<th scope="col">Hình Ảnh</th>
					<th scope="col">Trạng Thái</th>
					<th scope="col">Quản Lý</th>

				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($brand as $key =>$bra) {

					?>
					<tr>
						<th scope="row"><?php echo $key?></th>
						<td><?php echo $bra->title?></td>
						<td><?php echo $bra->description?></td>
						<td>
							<img src="	<?php echo base_url('uploads/brand/'.$bra->image) ?>" width = "150" height = "150">
						</td>
						<td>
							<?php
							if ($bra->status ==1){
								echo 'Kích Hoạt';
							}
							else{
								echo 'Không Kích Hoạt';
							}
							?>
						</td>
						<td>
							<a href="<?php echo base_url('brand/edit/'.$bra->id) ?> " class="btn btn-warning">Sửa</a>

							<a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="<?php echo base_url('brand/delete/'.$bra->id) ?>" class="btn btn-danger">Xóa</a>
						</td>
					</tr>
					<?php
				}
				?>

				</tbody>
			</table>
		</div>
	</div>
