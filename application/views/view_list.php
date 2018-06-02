<?php
$data['title'] = 'View List | Foodmate';
$data['active'] = 'lists';
$this->load->view('template/header', $data);
?>

<h1 class="mt-5 text-center"><?php echo $list_name ?></h1>

<h2 class="mb-5 mt-5 text-center">Ingredients</h2>
<ul class="list-group text-center">
<?php
  foreach($list_ingredients as $ingredient)
  {
    $quantity = $ingredient->quantity + 0; // get rid of useless 0's
    echo '<li class="list-group-item">'.$quantity.' '.$ingredient->unit_name.' '.$ingredient->name.'</li>';
  }
?>


<!--
<pre>
  <?php
  //print_r($list_recipes);
  //print_r($list_ingredients);
  ?>
</pre>
-->

<?php $this->load->view('template/footer'); ?>
