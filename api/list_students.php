<?php
require 'db.php';

header('Content-Type: application/json');

$sql = "SELECT id, name, email, date_of_birth, nationality, education_background, created_at FROM students";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode(["status" => true, "students" => $students]);
?>
