<?php
session_start(); 
require 'C:\xampp3\htdocs\tugas\data\connection.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST['action'] === "register") {
        // Ambil nilai variabel dari $_POST
        $USERNAME = $_POST['username'];
        $PASSWORD = $_POST['password'];
        $HASH_PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);

        try {
            $stmt = $DB -> prepare("INSERT INTO `users`(`username`, `password`) VALUES (?, ?)");
            $stmt -> bind_param("ss", $USERNAME, $HASH_PASSWORD);
            $stmt -> execute();
    
            if ($stmt->affected_rows > 0){
                $_SESSION['alert'] = [
                    'type' => 'success',
                    'title' => 'Berhasil membuat akun'
                ];
                header("Location: /tugas/index.php");
            }
        } catch (Exception $e) {
            // echo $stmt -> errno;
            if ($stmt -> errno === 1062) {
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'title' => 'Gagal membuat akun',
                    'text' => 'Username ' . $USERNAME . ' sudah terdaftar'
                ];
                header("Location: /tugas/register.php");
            }
        }

    }
}

?>
