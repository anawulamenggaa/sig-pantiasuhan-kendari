<?php
session_start(); 
require 'C:\xampp3\htdocs\tugas\data\connection.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST['action'] === "login") {
        // Ambil nilai variabel dari $_POST
        $USERNAME = $_POST['username'];
        $PASSWORD = $_POST['password'];

        $stmt = $DB -> prepare("SELECT * FROM users WHERE username = ?");
        $stmt -> bind_param("s", $USERNAME);
        $stmt -> execute();

        $user = $stmt -> get_result() -> fetch_assoc();

        if ($user && password_verify($PASSWORD, $user['password'])){
           $_SESSION['user_id'] = $user['id'];
           $_SESSION['alert'] = [
               'type' => 'success',
               'title' => 'Login berhasil'
           ];
           header("Location: /tugas/dashboard.php");
        } else {

            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Periksa Kembali',
                'text' => 'Username atau password mungkin salah'
            ];
            header("Location: /tugas/index.php");
        }
    }
}

?>
