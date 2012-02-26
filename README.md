CodeIgniter RedBean
===================

RedBean is an object-relation mapping (ORM) tool that allows you to store objects (beans) in a database without the requirement of a mapping schema. RedBean makes your life easier by doing the dull work for you; creating databases (SQLite), creating tables, creating columns, resizing and adjusting columns, adding unique indexes to link tables, creating views, deploying databases and so on. Read more about RedBean on: http://redbeanphp.com

Installation
------------

Place the files from the repository in their respective folders (or use spark). RedBean will automatically use the database configuration from the config/database.php file.

Documentation
-------------

You can find the original RedBean documentation at: http://www.redbeanphp.com/manual/

All calls made to this library will be passed on to the RedBean class, so all the original functions are still available.

Example
-------

    // Load the library (or use spark)
    $this->load->library('rb');
    
    // Generate an empty 'book' bean
    $book = $this->rb->dispense('book');
    $book->title = 'Hello World';
    
    // Generate an empty 'author' bean
    $author = $this->rb->dispense('author');
    $author->name = 'God';
    
    // Connect author to book
    $book->author = $author;
    
    // Store the bean
    $id = $this->rb->store($book);
    
    // Reload the bean
    $world = $this->rb->load('book', $id);
    
    // Display the title and author
    echo $world->author->name . " : " . $world->title;
    
You can still use the original `R::` static object if you prefer.