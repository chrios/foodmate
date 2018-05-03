<?php
$data['title'] = 'Foodmate';
$this->load->view('template/header', $data);
?>
<h1 class="display-1">Welcome.</h1>

<div class="row">
<?php
	foreach($user_recipes As $recipe)
	{
		echo '
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">' .
						$recipe .
						'</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        	<a href="#" class="btn btn-primary">Go somewhere</a>
	      </div>
	    </div>
	  </div>';
	}
 ?>
</div>
<!-- cards -->




  <?php $this->load->view('template/footer'); ?>
