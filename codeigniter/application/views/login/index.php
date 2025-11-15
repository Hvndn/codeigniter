<div class="container">
    <h1>Login Admin</h1>
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
    <?php echo validation_errors(); ?>
    <form action="<?php echo base_url('login-user') ?>" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>