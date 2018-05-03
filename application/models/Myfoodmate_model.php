<?php
class Myfoodmate_model extends CI_Model {

  public function get_recipes()
  {
    $userid = $this->ion_auth->user()->row()->id;

    $this->db->select('name');
    $this->db->where('user_id', $userid);
    $query = $this->db->get('recipe');

    return $query->row_array();
  }

  public function get_lists()
  {

  }

  public function get_inventory()
  {

  }



}
