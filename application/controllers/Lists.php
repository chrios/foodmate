<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {
  public function index()
  {
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }
    //manage recipes here
    $this->load->view('lists.php');

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
