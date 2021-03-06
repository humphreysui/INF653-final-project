<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  require('../../config/Database.php') ;
  require('../../models/Category.php') ;

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $category = new Category($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if (!empty($data->category)){
    
    $category->category = $data->category;

    // Create category
    if($category->create()) {
      echo json_encode(
        array('message' => 'category Created')
      );
    } else {
      echo json_encode(
        array('message' => 'category Not Created')
      );
    }
   
  }else{
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
  }



