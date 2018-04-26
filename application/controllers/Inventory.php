<?php
class Inventory extends CI_Controller {

  public function index() {
    $this->load->view('templates/header');
    echo 'inventory management';
		$this->load->view('templates/footer');
  }

  public function scan() {
    $this->load->view('templates/header');
    echo 'scan receipt';
		$this->load->view('templates/footer');
  }

}
