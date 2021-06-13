<?php 

include('../database/DB.php');

$subjectID = $_POST['subjectID'];

if(!empty($subjectID)){
    // $sql = "SELECT s.name AS subject_name, s.id AS subject_id 
    //         FROM subject s 
    //         JOIN workload wl ON s.id = wl.subject_id 
    //         JOIN lecturer l ON wl.lecturer_id = l.id 
    //         WHERE l.id = {$lecturerID};";
    $sql = "SELECT l.id AS lecturer_id, l.name AS lecturer_name 
            FROM SUBJECT S 
            JOIN workload wl ON s.id = wl.subject_id 
            JOIN lecturer l ON wl.lecturer_id = l.id
            WHERE S.id = '$subjectID'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '<option value="' . $row['lecturer_id'] . '">' . $row['lecturer_name'] . '</option>';
        }
    }else
        echo '<option value="">Lecturer Not Available</option>';
}
