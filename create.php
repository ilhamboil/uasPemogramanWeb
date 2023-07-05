<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../models/employees.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Employee($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->nama = $data->nama;
    $item->telepon = $data->telepon;
    $item->laptop = $data->laptop;
    $item->status = $data->status;
    $item->created = $data->created;
    
    if($item->createEmployee()){
        echo json_encode(['message'=>'Employee created successfully.']);
    } else{
        echo json_encode(['message'=>'Employee could not be created.']);
    }
?>
