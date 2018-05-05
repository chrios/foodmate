<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('lists_model');
    }
/*
* Display the lists of the user currently logged in.
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
    //manage lists here
    $this->load->view('lists', $data);

  }

  public function new()
  {
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }
    //add new recipe here
    $this->load->view('lists/new');

  }
}
