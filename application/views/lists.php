<?php
$data['title'] = 'View Shopping Lists | Foodmate';
$data['active'] = 'lists';
$this->load->view('template/header', $data);
?>

<pre>
<?php var_dump($user_lists); ?>
</pre>


<?php $this->load->view('template/footer'); ?>
