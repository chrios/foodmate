<?php
$data['title'] = 'Edit List | Foodmate';
$data['active'] = 'lists';
$this->load->view('template/header', $data);
?>

<h1 class="mt-5">Editing <?php echo $list_name ?></h1>

<!-- iterate through each recipe_ingredient
create multiselect input preloaded with recipe_ingredient
associate multiselect input with step_id
allow user to add ingredients
allow user to add units
allow user to create more recipe_ingredients in the recipe
-->
<h2 class="mt-4">Recipes</h2>
<table class="table table-sm mt-4" id="ingredientTable">
  <thead>
    <tr>
      <th scope="column">Recipe</th>
      <th class="text-right" style="width: 16.66%" scope="column">Action</th>
    </tr>
  </thead>
  <tbody id="ingredients">
<?php
  foreach($list_recipes as $list_recipe)
  {
    echo    '<tr>'.
            '<td class="align-middle">'.
              $list_recipe->name.
            '</td>'.
            '<td class="text-right">'.
              form_open("lists/edit/$list_id", 'class="mb-0"').
              '<input type="hidden" name="delete_recipe_from_list" value="'.$list_recipe->id.'">'.
              '<button class="btn btn-danger btn-sm">'.
                '<span class="oi oi-trash" title="Delete" aria-hidden="true"></span> Delete'.
              '</button>'.
              form_close().
            '</td>'.
          '</tr>';
  }
 ?>
 <?php echo form_open("lists/edit/$list_id"); ?>
    <tr id="addRecipeRow" style="display: none;">
     <td>
       <select name="addRecipe" class="form-control" value="" id="recipeInput">
         <?php foreach($all_recipes as $recipe)
         {
           echo '<option>'.$recipe->name.'</option>';
         } ?>
       </select>
     </td>
     <td class="text-right align-middle">
         <button class="btn btn-success btn-sm"><span class="oi oi-task" title="Delete" aria-hidden="true"></span> Add</button>
         <a class="btn btn-warning ml-1 btn-sm" style="color:white" id="cancelRecipeButton"><span class="oi oi-x" title="Delete" aria-hidden="true"></span> Cancel</a>
       <?php echo form_close(); ?>
     </td>
   </tr>
  </tbody>
 </table>

 <button class="btn btn-block btn-success" id="addRecipeButton">
   Add recipe
 </button>


 <script>
 $("#cancelRecipeButton").on("click", function(){
 	$("#addRecipeRow").toggle();
   $("#addRecipeButton").toggle();
 });

 $("#addRecipeButton").on("click", function(){
 	$("#addRecipeRow").toggle();
  $("#addRecipeButton").toggle();
 });

 </script>

<!--
<pre>
  <?php
  //print_r($list_recipes);
  //print_r($list_name);
  //print_r($all_recipes);
  ?>
</pre>
-->

<?php $this->load->view('template/footer'); ?>
