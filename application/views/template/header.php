<html>
<head>
<link rel="stylesheet" href="<?php echo base_url('/assets/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/css/fontawesome-all.min.css') ?>">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <script src="<?php echo base_url('/assets/js/jquery-3.3.1.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js') ?>"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url() . 'recipes'?>">Foodmate</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFoodmate" aria-controls="navbarFoodmate" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarFoodmate">
  <ul class="navbar-nav mr-auto">
    <?php if ($this->ion_auth->is_admin())
    {
      echo '<li class="nav-item';
      if($active === 'admin') {echo ' active';}
     echo '">'.
        '<a class="nav-link" href="'. base_url() . 'auth/">Admin</a>'.
        '</li>';
    } ?>
      <li class="nav-item <?php if($active === 'recipes') {echo ' active';} ?>">
        <a class="nav-link" href="<?php echo base_url() . 'recipes/'?>">Recipes</a>
      </li>
      <li class="nav-item <?php if($active === 'lists') {echo ' active';} ?>">
        <a class="nav-link" href="<?php echo base_url() . 'lists'?>">Lists</a>
      </li>
      <li class="nav-item <?php if($active === 'inventory') {echo ' active';} ?>">
        <a class="nav-link" href="<?php echo base_url() . 'inventory'?>">Inventory</a>
      </li>
    </ul>
<!--Login/logout buttons-->
<?php
if ($this->ion_auth->logged_in())
{
  echo '    <a class="btn btn-danger" href="' . base_url() . 'auth/logout' . '">Log out</a>';
} else {
  echo '    <a class="btn btn-success" href="' . base_url() . 'auth/login' . '">Login</a>';
}
?>
  </div>
</nav>
<div class="container text-left mt-3 mb-5">
