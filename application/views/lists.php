<?php
$data['title'] = 'View Shopping Lists | Foodmate';
$data['active'] = 'lists';
$this->load->view('template/header', $data);
?>


<h1 class="mt-5">Shopping Lists</h1>
<table class="table mt-4">
  <thead>
    <tr>
      <th>Name</th>
      <th class="text-right">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach($user_lists as $list)
  {
    $list_id = $list->list_id;
    $hidden = array('deleteList' => $list_id);
    echo  '<tr>'.
            '<td class="align-middle">'.
            '<a href="'.base_url().'lists/view/'.$list->list_id.'">'.
              $list->name.
            '</a>'.
            '</td>'.
            '<td class="text-right">'.
              form_open("lists/delete/$list->list_id", 'style="margin:0"', $hidden).
                '<a class="btn btn-warning btn-sm" href="'.base_url().'lists/edit/'.$list->list_id.'" style="color:white">'.
                  '<span class="oi oi-pencil" title="Delete" aria-hidden="true"></span> Edit'.
                '</a>'.
                '<button class="btn btn-danger btn-sm ml-1">'.
                  '<span class="oi oi-trash" title="Delete" aria-hidden="true"></span> Delete'.
                '</button>'.
              form_close().
            '</td>'.
          '</tr>';
  }
 ?>
 </tbody>
</table>

<button class="btn btn-block btn-success btn-lg" data-toggle="modal" data-target="#createListModal">Create new list</button>

<!--
      Create list modal
      Takes in list name
      POSTs to list/create
-->
<div class="modal fade" id="createListModal" tabindex="-1" role="dialog" aria-labelledby="createListModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Name your list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          $form_attr = array(
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'List name...'
          );
          echo form_open('lists/create');
          echo form_input('list_name', '', $form_attr);
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="oi oi-x" title="Delete" aria-hidden="true"></span> Cancel</button>
        <button type="submit" class="btn btn-success btn-sm"><span class="oi oi-plus" aria-hidden="true"></span> Create</button>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<!--
<pre>
<?php //print_r($user_lists); ?>
</pre>
-->

<?php $this->load->view('template/footer'); ?>
