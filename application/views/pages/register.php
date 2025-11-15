<section style="margin-left:30% ;"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng Ký Thành Viên Mới</h2>
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
                    <form action="<?php echo base_url('dang-ky') ?> " method="POST">
                        <label for=""> Tên</label>
                        <input type="text" name="name" placeholder="Name" />
                        <?php echo form_error('name'); ?>
                        <label for="">Mật Khẩu</label>
                        <input type="password" name="password" placeholder="Password" />
                        <?php echo form_error('password'); ?>
                        <label for=""> Email</label>
                        <input type="email" name="email" placeholder="Email Address" />
                        <?php echo form_error('email'); ?>
                        <label for="0">Số Điện Thoại</label>
                        <input type="text" name="phone" placeholder="Số Điện Thoại" />
                        <?php echo form_error('phone'); ?>
                        <label for="">Địa Chỉ</label>
                        <input type="text" name="address" placeholder="Địa Chỉ" />
                        <?php echo form_error('address'); ?>
                        <button type="submit" style="margin-left: 33%;border-radius:10px;font-size:20px" class="btn btn-success">Đăng ký</button>
                        <div style="text-align: center;">
                            <h5>Đã có tài khoản ?</h5>
                            <h5>Đăng nhập tại <a href="<?php echo base_url('dang-nhap') ?>">đây</a></h5>
                        </div>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>