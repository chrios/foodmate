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
  /*    view()    */
/*
* Gets recipe.id's referenced in a list. Returns array of recipe.id
*/
  public function get_list_recipe_ids($list_id)
  {
    $query = $this->db->select('recipe_id')->from('list_recipe')->where('list_id', $list_id)->get();
    return $query->result();
  }

  /*    edit()    */
/*
* Gets recipes referenced in a list.
*/
  public function get_list_recipes($list_id)
  {
    $query = $this->db->select('list_recipe.id, list_id, recipe_id, name, global_flag, user_id')->from('list_recipe')->join('recipe', "list_recipe.recipe_id = recipe.id and list_recipe.list_id = $list_id")->get();
    return $query->result();
  }
/*
* Gets user id of list
*/
  public function get_list_owner($list_id)
  {
    //get list user id
    $query = $this->db->select('user_id')->where('id', $list_id)->get('list');
    // return $user_id
    return $query->row();
  }
/*
* Gets list name from list_id
*/
  public function get_list_name($list_id)
  {
    //get list name
    $query = $this->db->select('name')->where('id', $list_id)->get('list');
    // return list.name
    return $query->row();
  }
/*
* Gets all recipe names that are global or belong to current user
*/
  public function get_global_and_user_recipes()
  {
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    //get recipes that are global/belong to user
    $where = "user_id = $curnt_userid OR global_flag = 1";
    $query = $this->db->select('name')->where($where)->get('recipe');
    return $query->result();
  }
/*
* Adds recipe to list from recipe.name and list.id
*/
  public function add_recipe_to_list($recipe_name, $list_id)
  {
    //get recipe id from name
    $query = $this->db->select('id')->from('recipe')->where('name', $recipe_name)->get();
    $recipe_id = $query->row()->id;

    //prepare insert
    $data = array(
      'list_id' => $list_id,
      'recipe_id' => $recipe_id
    );
    //insert new row into list_recipe
    $this->db->insert('list_recipe', $data);
    return 0;
  }
/*
* remove a recipe from list from its list_recipe.id
*/
  public function remove_recipe_from_list($list_recipe_id)
  {
    //remove recipe from list
    $this->db->delete('list_recipe', array('id' => $list_recipe_id));
    return 0;
  }
  /*    delete()    */
/*
* Deletes a list
*/
  public function delete_list($list_id)
  {
    $this->db->delete('list', array('id' => $list_id));
    return 0;
  }
}
