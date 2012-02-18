CodeIgniter RedBean
===================

RedBean is an object-relation mapping (ORM) tool that allows you to objects (beans) in a database without the requirement of a mapping schema. RedBean makes your life easier by doing the dull work for you; creating databases (SQLite), creating tables, creating columns, resizing and adjusting columns, adding unique indexes to link tables, creating views, deploying databases and so on. Read more about RedBean on: http://redbeanphp.com

Installation
------------

Place the files from the repository in their respective folders. RedBean will automatically use the database configuration from the config/database.php file.

Example
-------

	// Load the library (or use spark)
	$this->load->library('rb');
	
	// Ready. Now insert a bean!	
	$bean = $this->rb->dispense('leaflet');
	$bean->title = 'Hello World';
	
	// Store the bean
	$id = $this->rb->store($bean);
	
	// Reload the bean
	$leaflet = $this->rb->load('leaflet', $id);
	
	// Display the title
	echo $leaflet->title;
	
You can still use the original R:: static object if you prefer.