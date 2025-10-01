<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

$sql = "SELECT * FROM students WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(["status" => "success", "student_id" => $user['id']]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}
?>
