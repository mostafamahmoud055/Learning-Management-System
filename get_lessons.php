<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'lms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if (isset($_POST["course"])) {
        $course = $_POST["course"];
        $id = $_POST["id"];
        $grade = $_POST["grade"];

        $sql = "SELECT * FROM `lessons` WHERE grades_courses_id	 = $id";
        $result = $conn->query($sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);


        print_r(json_encode(['lessons' => $result]));
        $conn->close();
    }

}