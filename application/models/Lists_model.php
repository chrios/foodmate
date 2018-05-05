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
    $query = $this->db->select('id as list_id, name')->where('user_id', $user_id)->from('list')->get();
    return $query->result();
  }
  /*    create()    */
/*
* Creates a new list. Returns the new list's ID.
*/
  public function create_list($list_name)
  {
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    //Preload $data with needed columns
    $data = array(
      'name' => $list_name,
      'user_id' => $curnt_userid
    );
    //Create new list row
    $this->db->insert('list', $data);
    //Get new list ID
    $query = $this->db->select('id')->where('name', $list_name)->get('list');
    //Return new list ID)
    return $query->row();
  }



}
