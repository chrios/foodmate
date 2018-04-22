<?php

/*Main config file
 */

$config = array(
	"db" => array(
		"db1" => array(
			"dbname" => "foodmate",
			"username" => "foodmate_admin",
			"password" => "foodmate_admin",
			"host" => "localhost"
		)
	),
	"urls" => array(
		"baseUrl" => "http://foodmate.io"
	),
	"paths" => array(
		"models" => $_SERVER["DOCUMENT_ROOT"] . "../app/models",
		"controllers" => $_SERVER["DOCUMENT_ROOT"] . "../app/controllers",
		"views" => $_SERVER["DOCUMENT_ROOT"] . "../app/views"
	)
)

?>
