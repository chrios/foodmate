<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <!-- Bootstrap4 Stuff -->
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	  <!-- Foodmate custom styles -->
	  <link rel="stylesheet" href="../css/foodmate.css">
	  <!-- Slidout Nav CSS -->
	  <link rel="stylesheet" href="../css/vendor/slideout.css">
		<!-- Fontawesome -->
		<link rel="stylesheet" href="../css/vendor/fontawesome-all.min.css">
	  <meta name="viewport" content="720, initial-scale=1">
	</head>
<body>

	<!-- Navigation Slider -->
	<nav id="menu">
		<header>
			<div class="list-group text-light">
				<a href="" class="list-group-item list-group-item-action rounded-0 "><span class="slide-header"><h3>My Foodmate</h3></span></a>
				<a href="<?php echo base_url() . 'recipes';?>" class="list-group-item rounded-0 pl-5 ">My recipes</a>
				<a href="<?php echo base_url() . 'recipes/add';?>" class="list-group-item rounded-0 pl-5 ">Add new recipe</a>
				<a href="<?php echo base_url() . 'recipes/import';?>" class="list-group-item rounded-0 pl-5">Import recipe</a>
				<a href="<?php echo base_url() . 'lists';?>" class="list-group-item rounded-0 pl-5 ">Shopping lists</a>
				<a href="<?php echo base_url() . 'lists/new';?>" class="list-group-item rounded-0 pl-5 ">New shopping list</a>
				<a href="<?php echo base_url() . 'inventory';?>" class="list-group-item rounded-0 pl-5 ">Fridge & pantry</a>
				<a href="<?php echo base_url() . 'inventory/scan';?>" class="list-group-item rounded-0 pl-5 ">Scan receipt</a>
			</div>
		</header>
	</nav>

	<!-- Main Page body -->
	<main id="panel">
		<div class="fm-panel">

			<!-- toggle button for slideout nav -->
			<i class="fas fa-bars toggle-button"></i>

			<!-- Main panel container -->
			<div class="container-fluid">

				<!-- Header row -->
				<div class="row">
					<h1 class="h1">My Recipes</h1>
				</div>
