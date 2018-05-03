<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myfoodmate extends CI_Controller {
  public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
    $this->load->model('myfoodmate_model');

    $data['user_recipes'] = $this->myfoodmate_model->get_recipes();

    $this->load->view('user_homepage', $data);



	}
}
