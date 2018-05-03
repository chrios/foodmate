<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
  public function index()
  {
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }
    //manage recipes here
    $this->load->view('inventory.php');

  }
}
