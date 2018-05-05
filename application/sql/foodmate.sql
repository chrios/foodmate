USE ci;
  ----------------------------
  -- Ion Auth table structure
  --

  --
  --  Table structure for table 'groups'
  --

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  --  Dumping data for table 'groups'
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
     (1,'admin','Administrator'),
     (2,'members','General User');

  --
  --  Table structure for table 'users'
  --

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  --  Dumping data for table 'users'
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`)
VALUES
     ('1','127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,'1268889823','1268889823','1', 'Admin','istrator','ADMIN','0');

  --
  --  Table structure for table 'users_groups'
  --

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `uc_users_groups` UNIQUE (`user_id`, `group_id`),
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  -- Dumping data for table 'users_groups'
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
     (1,1,1),
     (2,1,2);
  --
  -- Table structure for table 'login_attempts'
  --

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  ------------------------------------------------------------
  -- Foodmate installation SQL script
  -- Creates new SQL database schema for foodmate application
  --

  --
  -- INGREDIENTS TABLE
  --

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`name` 					varchar(255) NOT NULL,
	`notes` 				varchar(255),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  -- Dumping data for table `ingredient`
INSERT INTO `ingredient` (`name`)
VALUES
	('penne pasta'),
	('extra virgin olive oil'),
	('chicken breast'),
	('bacon rasher'),
	('garlic clove'),
	('chicken stock'),
	('egg yolk'),
	('thickened cream'),
	('cornflour'),
	('grated parmesan'),
	('flat-leafed parsley');


  --
  -- UNIT TABLE
  --

DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`name` 					varchar(255) NOT NULL,
	`short`					varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  -- Dumping data for table `unit`
INSERT INTO `unit` (`name`, `short`)
VALUES
	('tablespoon', 'tbsp'),
	('gram', 'g'),
	('quantity', 'of'),
	('mililitres', 'ml'),
	('cup', 'cup');

  --
  -- RECIPE TABLE
  --

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE `recipe` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`name` 					varchar(255) NOT NULL,
	`global_flag` 	int(8) unsigned DEFAULT '0',
	`user_id`				int(16) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  -- Dumping Data for table `recipe`
INSERT INTO `recipe` (`name`, `user_id`)
VALUES
	('creamy chicken carbonara', 1);

  --
  -- RECIPE INGREDIENTS TABLE
  --

DROP TABLE IF EXISTS `recipe_ingredient`;
CREATE TABLE `recipe_ingredient` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`quantity`			DECIMAL(6,2) unsigned NOT NULL,
	`unit_id`				int(16) unsigned NOT NULL,
	`recipe_id`			int(16) unsigned NOT NULL,
	`ingredient_id`	int(16) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  -- Dumping data for table `recipe_ingredient`
INSERT INTO `recipe_ingredient` (`quantity`, `unit_id`, `recipe_id`, `ingredient_id`)
VALUES
	(500, 2, 1, 1),
	(1, 1, 1, 2),
	(500, 2, 1, 3),
	(250, 2, 1, 4),
	(2, 3, 1, 5),
	(1, 5, 1, 6),
	(2, 3, 1, 7),
	(0.75, 5, 1, 8),
	(1, 1, 1, 9),
	(0.5, 5, 1, 10),
	(2, 1, 1, 11);

  --
  -- RECIPE STEPS TABLE
  --

DROP TABLE IF EXISTS `step`;
CREATE TABLE `step` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`step_number`		int(16) unsigned NOT NULL,
	`step_text` 		varchar(255) NOT NULL,
	`recipe_id`			int(16) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  -- Dumping data for table `step`
INSERT INTO `step` (`step_number`, `step_text`, `recipe_id`)
VALUES
	(1, 'Cook the Coles Brand Penne in a saucepan of boiling water following packet directions. Drain.', 1),
	(2, 'Meanwhile, heat the Red Island Australian Extra Virgin Olive Oil in a frying pan over medium heat. Add chicken and cook for 4 mins, turning, until golden and cooked through. Transfer to a plate. Add bacon to the pan and cook, stirring, for 2 mins or until golden and starting to crisp.', 1),
	(3, "Whisk garlic, Campbell's Real Stock Chicken, egg yolks, cream, cornflour and half the parmesan in a bowl. Season. Return the chicken to the pan over low heat. Add the egg mixture and pasta. Cook, tossing, for 1-2 mins or until pasta is coated and the sauce thickens. Top with parsley and remaining parmesan.", 1);

  --
  -- RECIPE TAGS TABLE
  --
  --CREATE TABLE `recipe_tag` (
  --	`tag`
  --	`recipe_id`					int(16) unsigned NOT NULL,
  --	PRIMARY KEY (`id`),
  --	KEY (`fk_recipe_tag_recipe_recipetag1_idx`) (`recipe_id`),
  --	CONSTRAINT `fk_recipe_tag_recipe_recipetag1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
  --) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  -- INVENTORY TABLE
  --

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`quantity`			int(16) unsigned NOT NULL,
	`location`			int(16) unsigned NOT NULL,
	`unit_id`				int(16) unsigned NOT NULL,
	`user_id`				int(16) unsigned NOT NULL,
	`ingredient_id`	int(16) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  --  LIST TABLE
  --

DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name`          varchar(50) unsigned NOT NULL,
	`user_id`				int(16) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  --  LIST INGREDIENTS TABLE
  --

DROP TABLE IF EXISTS `list_ingredient`;
CREATE TABLE `list_ingredient` (
	`id` 						int(16) unsigned NOT NULL AUTO_INCREMENT,
	`quantity`			int(16) unsigned NOT NULL,
	`unit_id`				int(16) unsigned NOT NULL,
	`list_id`				int(16) unsigned NOT NULL,
	`ingredient_id`	int(16) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  -- Add Constraints to tables
  --

ALTER TABLE `recipe`
ADD CONSTRAINT `fk_recipe_users_recipe1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `recipe_ingredient`
ADD CONSTRAINT `fk_recipe_ingredient_unit_recipeingredient1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_recipe_ingredient_recipe_recipeingredient1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_recipe_ingredient_ingredient_recipeingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `step`
ADD CONSTRAINT `fk_step_recipe_step1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `inventory`
ADD CONSTRAINT `fk_inventory_unit_inventory1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inventory_user_inventory1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inventory_ingredient_inventory1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `list`
ADD CONSTRAINT `fk_list_user_list1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `list_ingredient`
ADD CONSTRAINT `fk_list_ingredient_unit_list1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_list_ingredient_list_list1` FOREIGN KEY (`list_id`) REFERENCES `list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_list_ingredient_ingredient_list1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

  --
  -- Add indexes to tables
  --

ALTER TABLE `recipe`
ADD KEY `fk_recipe_users_recipe1_idx` (`user_id`);

ALTER TABLE `recipe_ingredient`
ADD KEY `fk_recipe_ingredient_unit_recipeingredient1_idx` (`unit_id`),
ADD KEY `fk_recipe_ingredient_recipe_recipeingredient1_idx` (`recipe_id`),
ADD KEY `fk_recipe_ingredient_ingredient_recipeingredient1_idx` (`ingredient_id`);

ALTER TABLE `step`
ADD KEY `fk_step_recipe_step1_idx` (`recipe_id`);

ALTER TABLE `inventory`
ADD KEY `fk_inventory_unit_inventory1_idx` (`unit_id`),
ADD KEY `fk_inventory_user_inventory1_idx` (`user_id`),
ADD KEY `fk_inventory_ingredient_inventory1_idx` (`ingredient_id`);

ALTER TABLE `list`
ADD KEY `fk_list_user_list1_idx` (`user_id`);

ALTER TABLE `list_ingredient`
ADD KEY `fk_list_ingredient_unit_list1_idx` (`unit_id`),
ADD KEY `fk_list_ingredient_list_list1_idx` (`list_id`),
ADD KEY `fk_list_ingredient_ingredient_list1_idx` (`ingredient_id`);

  --
  -- CodeIgniter Sessions table
  --

CREATE TABLE `ci_sessions` (
  `id`            varchar(40) NOT NULL,
  `ip_address`    varchar(45) NOT NULL,
  `timestamp`     int(10)     unsigned DEFAULT 0 NOT NULL,
  `data`          blob        NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
);
