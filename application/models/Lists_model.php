<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lists_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }
/*
* Returns the lists of the user currently logged in.
*/
  public function get_user_lists($user_id)
  {
    $query = $this->db->select('id as list_id')->where('user_id', $user_id)->from('list')->get();
    return $query->result();
  }



}
