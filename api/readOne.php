<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../config/errors.php';
include_once '../classes/Courses.php';
 
// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate post object
$course = new Courses($db);

// Get code
$course->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get course
$course->readOne();

// Create array
$course_arr = array(
    'id' => $course->id,
    'code' => $course->code,
    'course_name' => $course->course_name,
    'progression' => $course->progression,
    'syllabus' => $course->syllabus
); 

// JSON
print_r(json_encode($course_arr));