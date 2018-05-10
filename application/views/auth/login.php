<?php
$data['title'] = 'Log in | Foodmate';
$data['active'] = '';
$this->load->view('template/header', $data);
?>
<div class="text-center">
<h1 class="mt-5 display-1 d-none d-md-block">Welcome to Foodmate.</h1>
<h1 class="mt-5 display-1 d-none d-sm-block d-md-none">Welcome.</h1>
<h1 class="mt-5 display-3 d-sm-none">Welcome.</h1>
<!--<h2 class="mt-5 display-4">Please login below.</h2>-->

<?php echo form_open("auth/login");?>
<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-6">
<div class="form-group mt-5 mw-100">
  <?php echo form_input($identity, '', 'class="form-control" placeholder="Enter your email address..." type="email"');?>
  <?php echo form_input($password, '', 'class="form-control mt-3" placeholder="Enter your password..." type="password"');?>
</div>


<p><?php echo form_submit('submit', 'Login', 'class="btn btn-success btn-block mt-3"');?></p>

<div class="form-check">
  <label class="form-check-label">Remember me?</label>
  <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"', 'class="form-check-input mt-3"');?>
</div>

<p class="mt-3"><a href="forgot_password">Forgot your password?</a></p>

<?php echo form_close();?>


</div>
</div>

<?php $this->load->view('template/footer'); ?>
