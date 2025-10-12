<?php
require 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (isset($data->email) && isset($data->password)) {
    $email = $conn->real_escape_string($data->email);
    $password = $data->password;

    $sql = "SELECT * FROM students WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();

        if (password_verify($password, $student['password'])) {
            // Remove password before sending back
            unset($student['password']);
            echo json_encode(["status" => true, "message" => "Login successful", "student" => $student]);
        } else {
            echo json_encode(["status" => false, "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["status" => false, "message" => "Email not found"]);
    }

} else {
    echo json_encode(["status" => false, "message" => "Email and password are required"]);
}
?>
