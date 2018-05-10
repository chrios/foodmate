<?php
$data['title'] = 'Edit Recipe | Foodmate';
$data['active'] = 'recipes';
$this->load->view('template/header', $data);
?>

<h1 class="mt-5">Editing <?php echo $recipe_name ?></h1>

<!-- iterate through each recipe_ingredient
create multiselect input preloaded with recipe_ingredient
associate multiselect input with step_id
allow user to add ingredients
allow user to add units
allow user to create more recipe_ingredients in the recipe
-->
<h2 class="mt-4">Ingredients</h2>
<table class="table table-sm mt-4" id="ingredientTable">
  <thead>
    <tr>
      <th scope="column" style="width: 16.66%">Amount</th>
      <th scope="column" style="width: 16.66%">Unit</th>
      <th scope="column">Ingredient</th>
      <th class="text-right" style="width: 16.66%" scope="column">Action</th>
    </tr>
  </thead>
  <tbody id="ingredients">
<?php
  foreach($recipe_ingredients as $ingredient)
  {
    echo  '<tr>'.
            '<td class="align-middle">'.
              $ingredient->quantity.
            '</td>'.
            '<td class="align-middle">'.
              $ingredient->short.
            '</td>'.
            '<td class="align-middle">'.
              $ingredient->name.
            '</td>'.
            '<td class="text-right">'.
              form_open("recipes/edit/$recipe_id").
              '<input type="hidden" name="deleted_ingredient" value="'.$ingredient->recipe_ingredient_id.'">'.
              '<button class="btn btn-danger btn-sm">'.
                'Delete'.
              '</button>'.
              form_close().
            '</td>'.
          '</tr>';
  }
 ?>


   <?php echo form_open("recipes/edit/$recipe_id"); ?>
   <tr id="addIngredientRow" style="display: none;">
    <td><input type="number" min="0" step="0.01" name="quantity" class="form-control" placeholder="Amount" id="quantityInput"></td>
    <td>
      <select name="units" class="form-control" value="" id="unitInput">
        <?php foreach($units as $unit)
        {
          echo '<option>'.$unit->short.'</option>';
        } ?>
    </td>
    <td><input type="text" name="ingredient" class="form-control" placeholder="Ingredient" id="ingredientInput"></td>
    <td class="text-right">
      <div class="btn-group" role="group">
        <button class="btn btn-success">Save</button>
        <a class="btn btn-warning" id="cancelIngredient">Cancel</a>
      </div>
      <?php echo form_close(); ?>
    </td>
  </tr>
 </tbody>
</table>

<button class="btn btn-block btn-success" id="addIngredientButton">
  Add ingredient
</button>

<?php
/*
* Generate a 1-dimensional array for the ingredients for the autocomplete in the forms
*/
//$ingredientArray = array();
//foreach($ingredients as $ingredient)
//{
//  $ingredientArray[] = $ingredient->ingredient_name;
//}
?>

<script>
//$(function() {
  /*
  * Put the PHP array into JSON format for the javascript array

    */

  //var ingredients = <?php //echo json_encode($ingredientArray); ?>;
  //set autocomplete on the ingredientInput field
//  $("#ingredientInput").autocomplete({
//    source: ingredients
//  });
//});
/*
* dynamic ingredient form
*/
$("#cancelIngredient").on("click", function(){
  //clear value in input fields
  $("#ingredientInput").val('');
  $("#unitInput").val('');
  $("#quantityInput").val('');
	$("#addIngredientRow").toggle();
  $("#addIngredientButton").toggle();
});

$("#addIngredientButton").on("click", function(){
	$("#addIngredientRow").toggle();
  $("#addIngredientButton").toggle();
});

</script>


<!-- iterate through each step
create text input
associate text input with step_id
allow user to create more steps in the recipe
-->
<h2 class="mt-4">Steps</h2>
<table class="table table-sm mt-4">
  <thead>
    <tr>
      <th scope="column" style="width: 16.66%">Step</th>
      <th scope="column">Method</th>
      <th class="text-right" scope="column" style="width: 16.66%">Action</th>
    </tr>
  </thead>
  <tbody id="steps">
<?php
  foreach($steps as $step)
  {
    echo  '<tr>'.
            '<td class="align-middle">'.
              $step->step_number.
            '</td>'.
            '<td class="align-middle">'.
              $step->step_text.
            '</td>'.
            '<td class="text-right">'.
              form_open("recipes/edit/$recipe_id").
              '<input type="hidden" name="deleted_step" value="'.$step->step_id.'">'.
              '<button class="btn btn-danger btn-sm">'.
                'Delete'.
              '</button>'.
              form_close().
            '</td>'.
          '</tr>';
    $max_step = $step->step_number;
  }
 ?>

   <?php echo form_open("recipes/edit/$recipe_id"); ?>
   <tr id="addStepRow" style="display: none;">
    <td><?php
    if (isset($max_step))
    {
      echo $max_step+1;
    }
    else
    {
      echo 1;
    }
    ?></td>
    <td><textarea name="step_method" class="form-control" placeholder="Add step method here..." id="stepMethodInput" rows="3"></textarea></td>
    <td class="text-right">
      <div class="btn-group" role="group">
        <button class="btn btn-success">Save</button>
        <a class="btn btn-warning" id="cancelStep">Cancel</a>
      </div>
      <?php echo form_close(); ?>
    </td>
  </tr>
 </tbody>
</table>

<button class="btn btn-block btn-success" id="addStepButton">
  Add step
</button>

<script>
/*
* dynamic step form
*/
$("#cancelStep").on("click", function(){
  //clear value in input fields
  $("#stepMethodInput").val('');
  //toggle UI elements
	$("#addStepRow").toggle();
  $("#addStepButton").toggle();
});
$("#addStepButton").on("click", function(){
  //toggle UI elements
	$("#addStepRow").toggle();
  $("#addStepButton").toggle();
});
</script>

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
