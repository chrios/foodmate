<html>
<head>
<link rel="stylesheet" href="<?php echo base_url('/assets/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/open-iconic/font/css/open-iconic-bootstrap.css') ?>">
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
      <!--Logged in navbar elements-->
      <?php
        if ($this->ion_auth->logged_in())
        {
          // If an admin user
          if ($this->ion_auth->is_admin())
          {
            echo '<li class="nav-item';
            if($active === 'admin') {echo ' active';}
           echo '">'.
              '<a class="nav-link" href="'. base_url() . 'auth/">Admin</a>'.
              '</li>';
          }
          //And other, usual navbar items

          //Recipes controller link
          echo '<li class="nav-item ';
          if($active === 'recipes') {echo ' active';};
          echo '"><a class="nav-link" href="' . base_url() . 'recipes">Recipes</a></li>';

          //Lists controller link
          echo '<li class="nav-item ';
          if($active === 'lists') {echo ' active';};
          echo '"><a class="nav-link" href="' . base_url() . 'lists">Lists</a></li>';
          echo '</ul>';
          ?>

          <!-- Search bar -->
          <form class="form-inline my-lg-0 mr-3" action="<?php echo base_url('recipes/search');?>" method="get">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="string">
              <div class="input-group-append">
                <button class="btn btn-sm btn-success" type="submit">Search</button>
              </div>
            </div>
          </form>

          <?php

          //Logout button
          echo '<a class="btn btn-danger btn-sm" href="' . base_url() . 'auth/logout' . '">Log out</a>';
        }
      ?>
  </div>
</nav>
<div class="container text-left mt-3 mb-5">
