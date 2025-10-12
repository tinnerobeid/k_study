<?php
require 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->name) &&
    isset($data->email) &&
    isset($data->password) &&
    isset($data->date_of_birth) &&
    isset($data->nationality) &&
    isset($data->education_background)
) {
    $name = $conn->real_escape_string($data->name);
    $email = $conn->real_escape_string($data->email);
    $password = password_hash($data->password, PASSWORD_BCRYPT);
    $dob = $data->date_of_birth;
    $nationality = $conn->real_escape_string($data->nationality);
    $education = $conn->real_escape_string($data->education_background);

    $check = $conn->query("SELECT id FROM students WHERE email = '$email'");
    if ($check->num_rows > 0) {
        echo json_encode(["status" => false, "message" => "Email already registered"]);
        exit;
    }

    $sql = "INSERT INTO students (name, email, password, date_of_birth, nationality, education_background)
            VALUES ('$name', '$email', '$password', '$dob', '$nationality', '$education')";

    if ($conn->query($sql)) {
        echo json_encode(["status" => true, "message" => "Registration successful"]);
    } else {
        echo json_encode(["status" => false, "message" => "Error: " . $conn->error]);
    }

} else {
    echo json_encode(["status" => false, "message" => "All fields are required"]);
}
?>
