<?php
class Lists extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->load->view('templates/header');
    echo 'shopping list management';
		$this->load->view('templates/footer');
  }

  public function new() {
    $this->load->view('templates/header');
    echo 'create new list';
		$this->load->view('templates/footer');
  }

}
