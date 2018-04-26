<?php
class Recipes extends CI_Controller {

  public function index() {
    $this->load->view('templates/header');
    echo 'recipe management';
		$this->load->view('templates/footer');
  }

  public function add() {
    $this->load->view('templates/header');
    echo 'add recipe';
		$this->load->view('templates/footer');
  }

  public function import() {
    $this->load->view('templates/header');
    echo 'import recipe';
		$this->load->view('templates/footer');
  }

}
