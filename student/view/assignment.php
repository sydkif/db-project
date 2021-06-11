<?php include('../../templates/header.php');

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$lecturerId = $_GET['lid'];
$userId = $_SESSION['userid'];

?>


<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/student/dashboard.php"></a>View Assignment / Tutorial / Lab</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th style="text-align: left;">Assignment/Tutorial/Lab</th>
                        <th style="text-align: center;">Your File</th>
                        <th style="text-align: center; width: 13%">Download Task</th>
                        <th style="text-align: center; width: 13%">Submission</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../../database/DB.php";
                    
                    //Retrieving all available assignment from table
                    $sql2 = "INSERT INTO assignment_student (assignment_id, student_id, lecturer_id, file_name, file, TYPE) 
                            (SELECT id, '$userId', '$lecturerId', '', '', '' FROM assignment WHERE subject_id = '$code') 
                            ON DUPLICATE KEY UPDATE assignment_id = assignment_id";
                    
                    $conn->query($sql2);
                    
                    //Retrieving assignments for display

                    $sql = "SELECT assgn.title AS title, assgn.file_name AS lecturerFile, assgn.file AS file, assgn.type AS type, assgnStud.file_name AS studentFile 
                            FROM assignment_student assgnStud
                            JOIN assignment assgn ON assgnStud.assignment_id = assgn.id
                            JOIN student stud ON assgnStud.student_id = stud.id
                            WHERE assgn.subject_id = '$code' AND stud.id = '$userId'";
                    
                    $result = $conn->query($sql);
                    $num=0;

                    if($result->num_rows>0){
                        while($row = $result->fetch_assoc()){
                            ++$num;
                    ?>
                        <tr>
                            <th><?= $num?></th>
                            <td><?= $row['title'] ?></td>
                            <td style="text-align: center;"><?= $row['studentFile'] ?></td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="Download Task">
                                    <i class="bi bi-file-earmark-arrow-down" style="font-size: 28px; color:dimgray;"></i>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="Submit Task">
                                    <i class="bi bi-file-earmark-arrow-up" style="font-size: 28px; color:darkgoldenrod;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php }
                    }else
                        echo "0 results";

                    $conn->close();
                    ?>

                </tbody>
            </table>
        </div>
    </div>



    <?php include('../../templates/footer.php'); ?>