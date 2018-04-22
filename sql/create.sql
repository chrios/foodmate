DROP DATABASE recipes;

CREATE DATABASE recipes;

USE recipes;

CREATE TABLE recipes (
	recipe_id int(15) NOT NULL AUTO_INCREMENT,
	recipe_name varchar(255),
	PRIMARY KEY (recipe_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE ingredients (
	ingredient_id int(15) NOT NULL AUTO_INCREMENT,
	ingredient_name varchar(255) NOT NULL,
	ingredient_notes varchar(255),
	PRIMARY KEY (ingredient_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE recipe_ingredients (
	recipe_ingredient_id int(15) NOT NULL AUTO_INCREMENT,
	recipe_id int(15) NOT NULL,
	ingredient_id int(15) NOT NULL,
	recipe_ingredient_quantity int(15),
	PRIMARY KEY (recipe_ingredient_id),
	CONSTRAINT FK_recipe_id FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
	CONSTRAINT FK_ingredient_id FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE steps (
	step_id int(15) NOT NULL AUTO_INCREMENT,
	recipe_id int(15) NOT NULL,
	step_number int(15) NOT NULL,
	step_method varchar(255) NOT NULL,
	PRIMARY KEY (step_id),
	CONSTRAINT FK_steps_recipe_id FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

show tables;

describe recipes;

describe ingredients;

describe recipe_ingredients;

describe steps;
