<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('lists_model');
      //check for auth
      if (!$this->ion_auth->logged_in())
      {
        redirect('auth/login');
      }
    }
/*
* http://base_url/lists
* Shows table of user lists with edit button and create new recipe button.
*/
  public function index()
  {
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    //collect lists of user logged in
    $user_lists = $this->lists_model->get_user_lists($curnt_userid);
    //pass lists into $data
    $data['user_lists'] = $user_lists;
    //view lists here
    $this->load->view('lists', $data);
  }
/*
* http://base_url/lists/create/
* Create list.
* POST to here to create a list.
*/
  public function create()
  {
    $list_name = $this->input->post('list_name');
    if ($list_name !== NULL)    //if $_POST is set
    {
      //Check if list already created
      //
      $list_id = $this->lists_model->create_list($list_name)->id; //create entry in recipe table
      //redirect("lists/edit/$list_name");
      redirect('lists'); //temp redirect for testing
    }
    else
    {
      redirect("lists"); //else redirect to view all recipes
    }
  }
/*
* http://base_url/lists/view/$list.id
* View list. Takes one argument, list.id
*
*/
  public function view($list_id)
  {
    $this->load->model('recipes_model');
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    //Check if list belongs to current user
    //
    //Redirect if argument is null
    if($list_id === NULL)
    {
      redirect('lists');
    }
    //check if list belongs to current user
    //
    //Get recipe.id 's of list
    $data['list_recipe'] = $this->lists_model->get_list_recipes($list_id);

    //Get recipe names
    //Get recipe ingredients
    $data['list_recipe_names'] = array();
    $data['list_recipe_ingredient'] = array();
    foreach($data['list_recipe'] as $recipe)
    {
      $data['list_recipe_names'] = $this->recipes_model->get_recipe_name($recipe->recipe_id);
      $data['list_recipe_ingredient'] = $this->recipes_model->get_recipe_ingredients($recipe->recipe_id);
    }

    //Get recipe

    $this->load->view('view_list', $data);
  }
/*
* http://base_url/lists/edit/$list_id
* Edit recipe. Takes one argument, recipe.id
* POST to here to edit a recipe
*/
  public function edit($list_id = NULL)
  {
    //Redirect if argument is null
    if($list_id === NULL)
    {
      redirect('lists');
    }
    //
    //ADD NEW RECIPE TO LIST
    //
    //Get $_POST variables for adding new recipe
    $add_recipe = $this->input->post('addRecipe');
    //if $_POST is set
    if ($add_recipe !== NULL)
    {
      //check if list belongs to current user
      $curnt_userid = $this->ion_auth->user()->row()->id;
      $list_userid = $this->lists_model->get_list_owner($list_id);
      if ($list_userid->user_id === $curnt_userid)
      {
        //insert recipe into list
        $this->lists_model->add_recipe_to_list($add_recipe, $list_id);
        //redirect to edit list
        redirect("lists/edit/$list_id");
      }
    }
    //
    // REMOVE RECIPE FROM LIST
    //
    //Get $_POST variables for removing recipe
    $remove_recipe = $this->input->post('delete_recipe_from_list');

    if ($remove_recipe !== NULL)
    {
      //check if list belongs to current user
      $curnt_userid = $this->ion_auth->user()->row()->id;
      $list_userid = $this->lists_model->get_list_owner($list_id);
      if ($list_userid->user_id === $curnt_userid)
      {
        //remove recipe from list
        $this->lists_model->remove_recipe_from_list($remove_recipe);
        //redirect to edit list
        redirect("lists/edit/$list_id");
      }
    }
    else
    {
      //check if list belongs to current user
      $curnt_userid = $this->ion_auth->user()->row()->id;
      $list_userid = $this->lists_model->get_list_owner($list_id);
      if ($list_userid->user_id === $curnt_userid)
      {
        $data['list_recipes'] = $this->lists_model->get_list_recipes($list_id);
        $data['list_name'] = $this->lists_model->get_list_name($list_id)->name;
        $data['list_id'] = $list_id;
        $data['all_recipes'] = $this->lists_model->get_global_and_user_recipes();
        /*
        $data['recipe_ingredients'] = $this->recipes_model->get_recipe_ingredients($recipe_id);
        $data['steps'] = $this->recipes_model->get_recipe_steps($recipe_id);
        $data['recipe_id'] = $recipe_id;
        $data['units'] = $this->recipes_model->get_units();
        $data['ingredients'] = $this->recipes_model->get_ingredients();
        $data['recipe_name'] = $this->recipes_model->get_recipe_name($recipe_id)->recipe_name;
        //$data['ingredients'] =
        $this->load->view('edit_recipe', $data);
        */


        //get all recipes in list

        //get all ingredients for recipes in list

        //add all like ingredients to each other

        //push through array of compiled ingredients to $data

        $this->load->view('edit_list', $data);
      }
    }
  }

}
