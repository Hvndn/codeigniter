<div class="container">
	<div class="card">
		<div class="card-header">
			Quản Lý Sản Phẩm
		</div>
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
		<div class="card-body">
			<a href="<?php echo base_url('product/create') ?>" class="btn btn-primary">Thêm Sản Phẩm</a>

			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">STT</th>
						<th scope="col">Tên Sản Phẩm </th>
						<th scope="col">Giá</th>
						<th scope="col">Số Lượng </th>
						<th scope="col">Danh Mục </th>
						<th scope="col">Thương Hiệu </th>
						<th scope="col">Slug </th>
						<th scope="col">Mô Tả</th>
						<th scope="col">Hình Ảnh</th>
						<th scope="col">Trạng Thái</th>
						<th scope="col">Quản Lý</th>

					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($product as $key => $pro) {

					?>
						<tr>
							<th scope="row"><?php echo $key ?></th>
							<td><?php echo $pro->title ?></td>
							<td><?php echo number_format($pro->price, 0, ',', '.') ?>VND</td>
							<td><?php echo $pro->quantity ?></td>
							<td><?php echo $pro->tendanhmuc ?></td>
							<td><?php echo $pro->tenthuonghieu ?></td>
							<td><?php echo $pro->slug ?></td>
							<td><?php echo $pro->description ?></td>
							<td>
								<img src="	<?php echo base_url('uploads/product/' . $pro->image) ?>" width="150" height="150">
							</td>

							<td>
								<?php
								if ($pro->status == 1) {
									echo 'Kích Hoạt';
								} else {
									echo 'Không Kích Hoạt';
								}
								?>
							</td>
							<td>
								<a href="<?php echo base_url('product/edit/' . $pro->id) ?> " class="btn btn-warning">Sửa</a>

								<a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="<?php echo base_url('product/delete/' . $pro->id) ?>" class="btn btn-danger">Xóa</a>
							</td>
						</tr>
					<?php
					}
					?>

				</tbody>
			</table>
		</div>
	</div>