<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Typ, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../config/errors.php';
include_once '../classes/Courses.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate post object
$courses = new Courses($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$courses->code = $data->code;
$courses->course_name = $data->course_name;
$courses->progression = $data->progression;
$courses->syllabus = $data->syllabus;

// Create post
if($courses->create()) {
    echo json_encode(
        array('message' => 'New course added')
    );
} else {
    echo json_encode(
        array('message' => 'Course not added')
    );
}