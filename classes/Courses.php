<?php

class Courses {
    // Params for DB
    private $conn;

    private $db_table = "moment5.courses";

    // Variables in table Courses
    public $id;
    public $code;
    public $course_name;
    public $progression;
    public $syllabus;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get All courses
    public function read() {
        $query = "SELECT * FROM " . $this->db_table . "";

        // Prepare and execute statment
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    // Get One course
    public function readOne() {
        $query = "SELECT * FROM ". $this->db_table ." WHERE id = ? LIMIT 0,1";

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind data
        $stmt->bindParam(1, $this->id);
        // Execute statement
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->code = $row['code'];
        $this->course_name = $row['course_name'];
        $this->progression = $row['progression'];
        $this->syllabus = $row['syllabus'];
    }


    // Create New course
    public function create() {        
        $query = "INSERT INTO
        ". $this->db_table ."
        SET
            code =:code,
            course_name =:course_name,
            progression =:progression,
            syllabus =:syllabus";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->progression = htmlspecialchars(strip_tags($this->progression));
        $this->syllabus = htmlspecialchars(strip_tags($this->syllabus));

        // Bind data
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':course_name', $this->course_name);
        $stmt->bindParam(':progression', $this->progression);
        $stmt->bindParam(':syllabus', $this->syllabus);

        // Execute
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update course
    public function update() {
        $query = "UPDATE
        ". $this->db_table ."
        SET
            code =:code,
            course_name =:course_name,
            progression =:progression,
            syllabus =:syllabus
        WHERE
            id =:id";

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->progression = htmlspecialchars(strip_tags($this->progression));
        $this->syllabus = htmlspecialchars(strip_tags($this->syllabus));

        // Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':course_name', $this->course_name);
        $stmt->bindParam(':progression', $this->progression);
        $stmt->bindParam(':syllabus', $this->syllabus);

        // Execute
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

  //Delete post
  public function delete() {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
            
        $query = "DELETE FROM moment5.courses WHERE id = $id";
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
        }
    }

}