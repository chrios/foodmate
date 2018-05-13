<?php
$data['title'] = 'Manage Recipes | Foodmate';
$data['active'] = 'recipes';
$this->load->view('template/header', $data);
?>

<h1 class="mt-5">Recipes</h1>
<table class="table mt-4">
  <thead>
    <tr>
      <th>Name</th>
      <th class="text-right">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach($recipes as $recipe)
  {
    echo  '<tr>'.
            '<td class="align-middle">'.
            '<a href="'.base_url().'recipes/view/'.$recipe['id'].'">'.
              $recipe['name'].
            '</a>'.
            '</td>'.
            '<td class="text-right">';


    //if recipe belong to user, show buttons
    if ($recipe['user_id'] === $this->ion_auth->user()->row()->id)
    {
      //create path for POST to share/unshare recipe
      $share_recipe = 'recipes/share/'.$recipe['id'];
      if ($recipe['global_flag'] == 1)
      {
        echo form_open($share_recipe, 'class="mb-0"', array("action" => "unshare"));
        echo        '<button class="btn btn-secondary" href="'.base_url().'recipes/share/'.$recipe['id'].'">'.
                      'Unshare'.
                    '</button>';
      }
      else if ($recipe['global_flag'] == 0)
      {
        echo form_open($share_recipe, 'class="mb-0"', array("action" => "share"));
        echo        '<button class="btn btn-primary" href="'.base_url().'recipes/share/'.$recipe['id'].'">'.
                      'Share'.
                    '</button>';
      }
      echo        '<a class="btn btn-warning ml-1" href="'.base_url().'recipes/edit/'.$recipe['id'].'">'.
                    'Edit'.
                  '</a>'.
                  '<a class="btn btn-danger ml-1" href="'.base_url().'recipes/delete/'.$recipe['id'].'">'.
                    'Delete'.
                  '</a>';
      echo form_close();
      echo    '</td>'.
            '</tr>';
    }
    else
    {
      echo 'Public Recipe'.'</td>'.'</tr>';
    }
  }
 ?>
 </tbody>
</table>

<button class="btn btn-block btn-success" data-toggle="modal" data-target="#createRecipeModal">
  Create new recipe
</button>

<!--
      Create recipe modal
      Takes in recipe name
      POSTs to recipes/create
-->
<div class="modal fade" id="createRecipeModal" tabindex="-1" role="dialog" aria-labelledby="createRecipeModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Name your recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          $form_attr = array(
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Recipe name...'
          );
          echo form_open('recipes/create');
          echo form_input('recipe_name', '', $form_attr);
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Create</button>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<pre>
  <?php// print_r($recipes); ?>
</pre>
<?php $this->load->view('template/footer'); ?>
