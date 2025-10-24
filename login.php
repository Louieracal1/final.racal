<?php
include('data.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Incorrect password!"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "⚠️ Username not found!"]);
    }
}
?>
