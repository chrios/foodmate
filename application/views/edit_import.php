<?php
$data['title'] = 'Edit Recipe | Foodmate';
$data['active'] = 'recipes';
$this->load->view('template/header', $data);
?>

<h1 class="mt-5">Editing Imported <?php echo $recipe_name ?></h1>

<!-- iterate through each recipe_ingredient
create multiselect input preloaded with recipe_ingredient
associate multiselect input with step_id
allow user to add ingredients
allow user to add units
allow user to create more recipe_ingredients in the recipe
-->
<h2 class="mt-4">Ingredients</h2>
<table class="table mt-4 table-sm" id="ingredientTable">
  <thead>
    <tr>
      <th scope="column" style="width: 12%" class="text-center"></th>
      <th scope="column" style="width: 20%">Quantity</th>
      <th scope="column">Ingredient</th>
    </tr>
  </thead>
  <tbody id="ingredients">
  <?php
    echo form_open("recipes/save_import/$recipe_id", 'class="mb-0"');
    $ingredientCounter = 0;
    foreach($imported_ingredients as $ingredient)
    {
      echo  '<tr id = "'.$ingredientCounter.'">'.
              '<td class="align-middle text-right">'.
                '<input type="number" min="0" step="0.01" name="quantity[]" class="form-control" placeholder="Amount" required>'.
              '</td>'.
              '<td class="align-middle">'.
                '<select name="units[]" class="form-control">';
      foreach($units as $unit)
      {
        echo '<option>'.$unit->unit_name.'</option>';
      }
      echo      '</select>'.
              '</td>'.
              '<td class="align-middle">'.
                form_input("ingredients[]", "$ingredient", 'class="form-control"');
              '</td>'.
            '</tr>';
      $ingredientCounter += 1;
    }
   ?>
 </tbody>
</table>

<!-- iterate through each step
create text input
associate text input with step_id
allow user to create more steps in the recipe
-->
<h2 class="mt-4">Steps</h2>
<table class="table table-sm mt-4">
  <thead>
    <tr>
      <th scope="column" style="width: 6%">Step</th>
      <th scope="column">Method</th>
    </tr>
  </thead>
  <tbody id="steps">
<?php
  $stepCounter = 1;
  foreach($imported_steps as $step)
  {
    echo  '<tr>'.
            '<td>'.
              $stepCounter.
            '</td>'.
            '<td>'.
              '<textarea name="steps[]" class="form-control" placeholder="Add step method here..." rows="3">'.trim($step).'</textarea>'.
            '</td>'.
          '</tr>';
    $stepCounter += 1;
  }
 ?>
 </tbody>
</table>

<button class="btn btn-block btn-success" id="saveRecipe">
  Save Recipe
</button>


<?php echo form_close(); ?>

<!-- post all data to /recipes/edit/$recipe_id -->

<pre>
  <?php
/*
    print_r($recipe_id);
    print_r($steps);
    print_r($recipe_ingredients);
    print_r($units);
    print_r($ingredients);
    print_r($recipe_name);
*/
  ?>
</pre>

<?php $this->load->view('template/footer'); ?>
