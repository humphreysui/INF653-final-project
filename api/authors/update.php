<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  require('../../config/Database.php') ;
  require('../../models/Author.php') ;

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate author object
  $author = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  if ( !empty($data->id) && !empty($data->author)){
    
    // Set ID to update
    $author->id = $data->id;
    $author->author = $data->author;

    // Update author
    if($author->update()) {
      echo json_encode(
        array('message' => 'author Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'author Not Updated')
      );
    }


  }else{
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
  }
