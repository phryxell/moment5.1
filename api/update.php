<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../config/Database.php';
include_once '../config/errors.php';
include_once '../classes/Courses.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate course object
$courses = new Courses($db);

// Get raw data
$data = json_decode(file_get_contents('php://input'));

// Set ID to update
$courses->id = $data->id;

$courses->code = $data->code;
$courses->course_name = $data->course_name;
$courses->progression = $data->progression;
$courses->syllabus = $data->syllabus;


// Update course
if($courses->update()) {
    echo json_encode(
        array('message' => 'Course updated')
    );
} else {
    echo json_encode(
        array('message' => 'Course not updated')
    );
}
