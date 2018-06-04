<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recipes_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }
/*
* Returns the recipes of the user currently logged in and global recipes.
* Author: Christopher Frew
*/
  public function get_recipes()
  {
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    $this->db->select('name, user_id, id, global_flag');
    $this->db->where("user_id = $curnt_userid OR global_flag = 1");
    $query = $this->db->get('recipe');
    //Return array of results from query
    return $query->result_array();
  }

  public function get_recipe_tags($recipes)
  {
    foreach ($recipes as $recipe)
    {
      //print_r($recipe['id']);
    }
  }
  /*    create()    */
/*
* Creates a new recipe. Returns the new recipe's ID.
* Author: Christopher Frew
*/
  public function create_recipe($recipe_name)
  {
    //Get id of currently logged in user
    $curnt_userid = $this->ion_auth->user()->row()->id;
    //Preload $data with needed columns
    $data = array(
      'name' => $recipe_name,
      'user_id' => $curnt_userid
    );
    //Create new recipe row
    $this->db->insert('recipe', $data);
    //Get new recipe ID
    $query = $this->db->select('id')->where('name', $recipe_name)->get('recipe');
    //Return new recipe ID)
    return $query->row();
  }
  /*    edit()    */
/*
* Returns recipe ingredients in an array. Takes recipe_id as argument.
* Author: Christopher Frew
*/
  public function get_recipe_ingredients($recipe_id)
  {
    //get Ingredients
    $this->db->select(
      'recipe_ingredient.id as recipe_ingredient_id,
      unit_id,
      ingredient_id,
      quantity,
      unit.name as unit_name,
      ingredient.name'
    );
    $this->db->from('recipe_ingredient');
    $this->db->join('unit', 'recipe_ingredient.unit_id = unit.id', 'left');
    $this->db->join('recipe', 'recipe_ingredient.recipe_id = recipe.id');
    $this->db->where(array('recipe_ingredient.recipe_id' => $recipe_id));
    $this->db->join('ingredient', 'recipe_ingredient.ingredient_id = ingredient.id', 'left');
    $query = $this->db->get();
    //return array of ingredients
    return $query->result();
  }
/*
* Returns recipe steps in an array
* Author: Christopher Frew
*/
  public function get_recipe_steps($recipe_id)
  {
    //get steps
    $this->db->select('id as step_id, step_number, step_text');
    $this->db->from('step');
    $this->db->where("recipe_id = $recipe_id");
    $query = $this->db->get();

    //return array of Steps
    return $query->result();
  }
/*
* Returns all units
* Author: Christopher Frew
*/
  public function get_units()
  {
    $query = $this->db->select('id as unit_id, name as unit_name')->from('unit')->get();
    return $query->result();
  }
/*
* Returns all ingredients in ingredient
* Author: Christopher Frew
*/
  public function get_ingredients()
  {
    $query = $this->db->select('id as ingredient_id, name as ingredient_name')->from('ingredient')->get();
    return $query->result();
  }
/*
* Returns recipe.name from recipe.id
* Author: Christopher Frew
*/
  public function get_recipe_name($recipe_id)
  {
    $query = $this->db->select('name as recipe_name')->from('recipe')->where('recipe.id', $recipe_id)->get();
    return $query->row();
  }
/*
* adds ingredient to recipe
* Author: Christopher Frew
*/
  public function add_ingredient_to_recipe($recipe_id, $ingredient, $quantity, $units)
  {
    //get the unit id from name
    $unit_id = $this->recipes_model->get_unit_id($units);
    //get the ingredient id from name
    $ingredient_id = $this->recipes_model->get_ingredient_id($ingredient);
    //if ingredient doesnt exist in database
    if ($ingredient_id === NULL)
    {
      //create new ingredient
      $this->recipes_model->add_ingredient($ingredient);
      //get the ingredient id from name
      $ingredient_id = $this->recipes_model->get_ingredient_id($ingredient);
    }
    //load data into array for insert
    $data = array(
      'quantity' => $quantity,
      'unit_id' => $unit_id->unit_id,
      'recipe_id' => $recipe_id,
      'ingredient_id' => $ingredient_id->ingredient_id
    );
    //insert new recipe_ingredient row
    $this->db->insert('recipe_ingredient', $data);
    //print_r($data);
    return 0;
  }
/*
* creates new ingredient in database and returns new id
* Author: Christopher Frew
*/
  public function add_ingredient($name)
  {
    $data = array(
      'name' => $name
    );
    $this->db->insert('ingredient', $data);
    $query = $this->db->select('id as ingredient_id')->from('ingredient')->where('ingredient.name', $name)->get();
    //echo '<pre>' . print_r($query);
    return $query;
  }
/*
* gets unit id from name
* Author: Christopher Frew
*/
  public function get_unit_id($unit_name)
  {
    $query = $this->db->select('id as unit_id')->from('unit')->where('unit.name', $unit_name)->get();
    return $query->row();
  }
/*
* gets ingredient id from name
* Author: Christopher Frew
*/
  public function get_ingredient_id($name)
  {
    $query = $this->db->select('id as ingredient_id')->from('ingredient')->where('ingredient.name', $name)->get();
    return $query->row();
  }
/*
* Deletes an ingredient from a recipe. Takes recipe_ingredit.id as argument.
* Author: Christopher Frew
*/
  public function delete_recipe_ingredient($recipe_ingredient_id)
  {
    $this->db->where('id', $recipe_ingredient_id)->delete('recipe_ingredient');
  }
/*
* Adds a step to a recipe. Takes recipe_id and step.step_text as argument
* Author: Christopher Frew
*/
  public function add_recipe_step($recipe_id, $step_text)
  {
    //get last step number and increment by 1
    $query = $this->db->select_max('step_number', 'highest_step_number')->where('recipe_id', $recipe_id)->get('step');
    $highest_step = $query->row()->highest_step_number;
    $highest_step += 1;
    //preload array with data
    $data = array(
      'step_number' => $highest_step,
      'step_text' => $step_text,
      'recipe_id' => $recipe_id
    );
    //insert step text and step number into step table
    $this->db->insert('step', $data);
    //reorder steps
    $this->recipes_model->reorder_step($recipe_id);
  }
/*
* Deletes a step from the database. Takes step_id as argument
* Author: Christopher Frew
*/
  public function delete_recipe_step($step_id)
  {
    $this->db->where('id', $step_id)->delete('step');
  }
/*
* Iterates through steps for a recipe and fixes the step_number to be order. Takes step.recipe_id as argument.
* Author: Christopher Frew
*/
  public function reorder_step($recipe_id)
  {
    //get all steps for recipe_id
    $this->db->select('step_number, id');
    $this->db->from('step');
    $this->db->where("recipe_id = $recipe_id");
    $query = $this->db->get();
    $steps = $query->result_array();

    //iterate through steps, checking step_number against count, and changing if required
    $count = 1;
    foreach($steps As $step)
    {
      if ($step['step_number'] != $count) //If step number is not in sequence
      {
        $this->db->set('step_number', $count);
        $this->db->where('id', $step['id']);
        $this->db->update('step'); // Set step number back into sequence
      }
      $count += 1; // increment count by 1
    }
  }
  /*    delete()    */
/*
* Returns the user.id of a recipe.id
* Author: Christopher Frew
*/
  public function check_recipe_owner($recipe_id)
  {
    $this->db->select('user_id')->from('recipe')->where("recipe.id = $recipe_id");
    $query = $this->db->get();
    return $query->result();
  }
/*
* Deletes a recipe by recipe.id
* Deletes all steps associated with that recipe
* Deletes all recipe_ingredient rows associated with that recipe
* Author: Christopher Frew
*/
  public function delete_recipe($recipe_id)
  {
    $this->db->where('recipe_id', $recipe_id)->delete('step');
    $this->db->where('recipe_id', $recipe_id)->delete('recipe_ingredient');
    $this->db->where('id', $recipe_id)->delete('recipe');
  }
/*
* Returns the recipe.id of recipes for the current user.
* Author: Christopher Frew
*/
  public function get_user_recipe_ids()
  {
    //Get id of currently logged in user
    $userid = $this->ion_auth->user()->row()->id;
    $this->db->select('id');
    $this->db->where('user_id', $userid);
    //Run query
    $query = $this->db->get('recipe');
    //Return array of results from query
    return $query->result_array();
  }
/*
* returns true if recipe is global or false if not global
* Author: Christopher Frew
*/
  public function check_recipe_global($recipe_id)
  {
    $this->db->select('global_flag');
    $this->db->where('id', $recipe_id);
    $query = $this->db->get('recipe');
    $results = $query->row();
    if ($results->global_flag == 1)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
  /*    share()    */
/*
* shares a recipe (makes global)
* Author: Christopher Frew
*/
  public function share_recipe($recipe_id)
  {
    $data = array(
      'global_flag' => 1
    );
    $this->db->where('id', $recipe_id);
    $this->db->update('recipe', $data);
  }
/*
* unshares a recipe
* Author: Christopher Frew
*/
    public function unshare_recipe($recipe_id)
    {
      $data = array(
        'global_flag' => 0
      );
      $this->db->where('id', $recipe_id);
      $this->db->update('recipe', $data);
    }
/*
*	Searches via POST string, returns recipes.
* Author: Shannan Mikic
*/
  public function search_recipes()
  {
    // Search String from User.
    $str = $this->input->get('string');

    //explode into array of Substrings
    $explode = explode(" ", $str);

    //build WHERE condition
    //Resulting string is something like -> (recipe.name LIKE "%example%" AND recipe.name LIKE "%string%" OR ingredient.name LIKE "%example%'.. etc)
    //Recipe Name Half of WHERE clause
    $whereString = '(';
    $i = 1;

    foreach ($explode as $e){
    	$whereString = $whereString.'recipe.name LIKE "%'.$e.'%"';
    	// If not at the last element, add an AND clause
    	if ($i < sizeof($explode)){
    		$whereString = $whereString.' AND ';
    		$i++;
    	}
    }
    $whereString = $whereString.')';

    //Ingredient Name half of WHERE clause
    $whereString = $whereString.' OR (ingredient.name LIKE ';
    $i = 1;

    foreach ($explode as $e){
    	$whereString = $whereString.'"%'.$e.'%"';
    	// If not at the last element, add an AND clause
    	if ($i < sizeof($explode)){
    		$whereString = $whereString.' AND ';
    		$i++;
    	}
    }
    $u_id = $this->ion_auth->user()->row()->id;
    $whereString = $whereString.') AND (recipe.user_id = "'.$u_id.'" OR recipe.global_flag = "1")';


    // Select IDs where recipe, or ingredient names match string.
    $this->db->distinct();
    $this->db->select('recipe.id, recipe.name, recipe.user_id, recipe.global_flag')->from('recipe');
    $this->db->join('recipe_ingredient', 'recipe.id = recipe_ingredient.recipe_id');
    $this->db->join('ingredient', 'recipe_ingredient.id = ingredient.id');
    //$this->db->where('recipe.name LIKE "%'.$str.'%" OR ingredient.name LIKE "%'.$str.'%"');
    $this->db->where($whereString);
    $this->db->order_by('recipe.name', 'ASC');
    $query = $this->db->get();

    // Returns resulting array
    return $query->result_array();
  }
/*
*	Scrapes a taste.com.au URL for a recipe and returns array with ingredients and steps
* Author: Shannan Mikic
*/
  public function scrape($url)
  {
  	// Takes and Input URL from Taste, Returns an Array of Arrays with Title, ingredients, and Method.
  	// Keys are 'title', 'ingredients', 'method'.
  	$html = file_get_contents($url);
  	$doc = new DOMDocument();

  	libxml_use_internal_errors(TRUE);

  	if(!empty($html)) { //IF any HTML is returned
  		//echo 'Successfully got HTML from: '.$url.' </br>';

  		$doc -> loadHTML($html);
  		libxml_clear_errors();
  		$xpath = new DOMXPath($doc);

  		$titleq = $xpath->query('//h1');
  		$title;

  		if ($titleq->length >0) {
  			foreach($titleq as $row){
  				$title = $row->nodeValue;
  			}
  		}

  		$ingredients = $xpath->query('//div[@class="ingredient-description"]');
  		$ingArray = [];
  		$i = 0;

  		if ($ingredients->length >0) {

  			foreach($ingredients as $row){
  				$ingArray[$i] = $row->nodeValue;
  				$i++;
  			}
  		}

  		$method = $xpath->query('//div[@class="recipe-method-step-content"]');
  		$methArray = [];
  		$i = 1;

  		if ($method -> length > 0) {
  			foreach($method as $r) {
  				$methArray[$i] = $r->nodeValue;
  				$i++;
  			}
  		}

  	}
		$recipe = array("title"=>$title, "ingredients"=>$ingArray, "method"=>$methArray);
		return $recipe;

	}
/*
*	Returns a recipe.id from the recipe name
* Author: Shannan Mikic
*/
	public function get_recipe_id($recipe_name)
  {
		// Select IDs where recipe, or ingredient names match string.
		$this->db->select('recipe.id')->from('recipe');
		$this->db->where('name = "'.$recipe_name.'"');
		$query = $this->db->get();

		// Returns resulting array
		return $query->result_array();
  }

}
