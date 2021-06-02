<?php 

include('../database/DB.php');

$lecturerID = $_POST['lecturerID'];

if(!empty($lecturerID)){
    $sql = "SELECT s.name AS subject_name, s.id AS subject_id 
            FROM subject s 
            JOIN workload wl ON s.id = wl.subject_id 
            JOIN lecturer l ON wl.lecturer_id = l.id 
            WHERE l.id = {$lecturerID};";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '<option value="' . $row['subject_id'] . '">' . $row['subject_name'] . '</option>';
        }
    }else
        echo '<option value="">Subject Not Available</option>';
}
