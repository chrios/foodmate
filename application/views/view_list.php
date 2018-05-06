<?php
$data['title'] = 'Edit Recipe | Foodmate';
$data['active'] = 'lists';
$this->load->view('template/header', $data);
?>

<h1 class="mt-5 text-center"><?php// echo $list_recipe ?></h1>
<div class="row">
  <div class="col-sm-6">
    <h2 class="mt-3 mb-3 text-center">Recipes</h2>
    <ul class="list-group">
      <?php
      foreach($list_recipe as $recipe)
      {
        echo '<li class="list-group-item">'.
        $recipe->recipe_id.
        ' '.
        '</li>';
      }
      ?>
    </ul>
  </div>
  <div class="col-sm-6">
    <h2 class="mt-3 mb-3 text-center">Ingredients</h2>
    <ol class="list-group text-center">
      <?php
      foreach($list_recipe_ingredient as $recipe_ingredient)
      {
        echo '<li class="list-group-item">'.
        $recipe_ingredient->quantity.
        ' '.
        $recipe_ingredient->short.
        ' '.
        $recipe_ingredient->name.
        '</li>';
      }
      ?>
    </ol>
  </div>
</div>

<pre>
  <?php
  print_r($list_recipe);
  print_r($list_recipe_ingredient);
  ?>
</pre>
