<?php
$data['title'] = 'Delete Recipe | Foodmate';
$data['active'] = 'recipes';
$this->load->view('template/header', $data);
?>
<h1 class="mt-5">Are you sure?</h1>

<p>This will delete the recipe, all of it's steps, and all of the ingredient amounts you have recorded.</p>

<?php echo form_open("recipes/delete/$recipe_id"); ?>


<a href="<?php echo base_url(); ?>recipes" class="btn btn-lg btn-secondary">Return</a>

<?php
$attr = array(
  'class' => 'btn btn-danger btn-lg'
);
echo form_submit('delete','Delete',$attr); ?>

<?php echo form_close(); ?>


<?php $this->load->view('template/footer'); ?>
