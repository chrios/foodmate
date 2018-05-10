<?php
$data['title'] = 'Edit Recipe | Foodmate';
$data['active'] = 'recipes';
$this->load->view('template/header', $data);
?>



<h1 class="mt-5 text-center"><?php echo $recipe_name ?></h1>

<div class="row">
  <div class="col-sm-4">
    <h2 class="mt-3 mb-3 text-center">Ingredients</h2>
    <ul class="list-group">
      <?php
      foreach($recipe_ingredients as $ingredient)
      {
        echo '<li class="list-group-item">'.
        $ingredient->quantity.
        ' '.
        $ingredient->short.
        ' '.
        $ingredient->name.
        '</li>';
      }
      ?>
    </ul>
  </div>
  <div class="col-sm-8">
    <h2 class="mt-3 mb-3 text-center">Method</h2>
    <ol class="list-group">
      <?php
      foreach($steps as $step)
      {
        echo '<li class="list-group-item">'.$step->step_number.'. '.$step->step_text.'</li>';
      }
      ?>
    </ol>
  </div>
</div>
