<section style="margin-left: 30%;"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng Nhập Tài Khoản CỦa Bạn</h2>
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
                    <form action="<?php echo base_url('login-customer') ?>" method="POST">
                        <label for="">Nhập Tên Đăng Nhập</label>
                        <input type="email" name="email" placeholder="Tên Đăng Nhập" />
                        <?php echo form_error('email'); ?>
                        <label for="">Nhập Mật Khẩu</label>
                        <input type="password" name="password" placeholder="Mật Khẩu" />
                        <?php echo form_error('password'); ?>
                        <button type="submit" style="margin-left: 29% ;border-radius:10px;font-size:20px " class="btn btn-success">Đăng Nhập</button>
                        <div style="text-align: center;">
                            <h5>Chưa có tài khoản ?</h5>
                            <h5>Đăng ký tại <a href="<?php echo base_url('register') ?>">đây</a></h5>
                        </div>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->