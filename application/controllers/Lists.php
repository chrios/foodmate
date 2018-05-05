<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('lists_model');
    }
/*
* http://base_url/lists
* Shows table of user lists with edit button and create new recipe button.
*/
  public function index()
  {
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    //collect lists of user logged in
    $user_lists = $this->lists_model->get_user_lists($curnt_userid);
    //pass lists into $data
    $data['user_lists'] = $user_lists;
    //view lists here
    $this->load->view('lists', $data);
  }
/*
* http://base_url/lists/create/
* Create list.
* POST to here to create a list.
*/
  public function create()
  {
    $list_name = $this->input->post('list_name');
    if ($list_name !== NULL)    //if $_POST is set
    {
      //Check if list already creates
      $list_id = $this->lists_model->create_list($list_name)->id; //create entry in recipe table
      //redirect("lists/edit/$list_name");
    }
    else
    {
      redirect("lists"); //else redirect to view all recipes
    }
  }


}
