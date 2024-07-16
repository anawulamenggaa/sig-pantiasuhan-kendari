<?php 

session_start();
require 'C:\xampp3\htdocs\tugas\data\connection.php';

echo print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if ($_POST['action'] === "update") {
        $LAT = $_POST['lat'];
        $LNG = $_POST['lng'];
        $NAME = $_POST['name'];
        $DESC = $_POST['description'];
        $MARKER_ID = $_POST['marker_id'];

        $stmt = $DB -> prepare("UPDATE `markers` SET `lat`=?,`lng`=?,`name`=?,`description`=? WHERE id = ?");
        $stmt -> bind_param("ddssi", $LAT, $LNG, $NAME, $DESC, $MARKER_ID);
        $stmt -> execute();
    
        if ($stmt -> affected_rows > 0) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'title' => 'Berhasil memperbarui marker'
            ];
            header("Location: /tugas/edit_marker.php");
        }
    }

    if ($_POST['action'] === "delete") {
        $stmt = $DB -> prepare("DELETE FROM `markers` WHERE id = ?");
        $stmt -> bind_param("i", $_POST['marker_id']);
        $stmt -> execute();
    
        if ($stmt -> affected_rows > 0) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'title' => 'Berhasil menghapus marker'
            ];
            header("Location: /tugas/edit_marker.php");
        }
    } 
}

?>