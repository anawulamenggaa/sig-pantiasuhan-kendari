<?php 
require 'C:\xampp3\htdocs\tugas\data\connection.php';

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $stmt = $DB -> prepare("SELECT * FROM `markers` WHERE `user_id` = ?");
    $stmt -> bind_param('i', $_SESSION['user_id']);
    $stmt -> execute();

    $_SESSION['markers'] = [
        'data' => $stmt -> get_result() ->fetch_all(MYSQLI_ASSOC)
    ];
}
?>