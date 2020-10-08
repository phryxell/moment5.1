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
$courses = new Courses($db);

// Query
$result = $courses->read();
// Get row count
$num = $result->rowCount();

// Check if any courses exists
if($num > 0) {
    $courses_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $course_item = array(
            'id' => $id,
            'code' => $code,
            'course_name' => $course_name,
            'progression' => $progression,
            'syllabus' => $syllabus
        );

        // Push to data
        array_push($courses_arr, $course_item);
    }
    // Change to JSON
    echo json_encode($courses_arr);
    http_response_code(200);

} else {
    http_response_code(404);
    echo json_encode(array('message' => 'No courses found'));
}
