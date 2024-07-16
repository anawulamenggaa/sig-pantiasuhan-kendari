<?php 
session_start();
require 'C:\xampp3\htdocs\tugas\data\connection.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $USERID = $_SESSION['user_id'];
    $LAT = $_POST['lat'];
    $LNG = $_POST['lng'];
    $NAME = $_POST['name'];
    $DESC = $_POST['description'];

    $stmt = $DB -> prepare("INSERT INTO `markers`(`user_id`, `lat`, `lng`, `name`, `description`) VALUES (?, ?, ?, ?, ?)");
    $stmt -> bind_param('iddss', $USERID, $LAT, $LNG, $NAME, $DESC);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Berhasil menambahkan marker'
        ];
        header("Location: /tugas/dashboard.php");
    }
}

?>