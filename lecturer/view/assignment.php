<?php include('../../templates/header.php');

$code = $_GET['code'];
$name = $_GET['name'];
$id = $_GET['id'];
$userID = $_SESSION['userid'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="javascript:history.back();"></a>Assignment / Tutorial / Lab Submission</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <h5>Title : <?= $id ?></h5>

        <div class="table-responsive shadow rounded">
            <table id="dashboard-student" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th style="text-align: left;">Student Name</th>
                        <th style="text-align: center;">Student ID</th>
                        <th style="text-align: center;">File Name</th>
                        <th style="text-align: center; width: 13%">View Content</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include('../../database/DB.php');

                    //Displaying data
                    $sql = "SELECT stud.name AS student_name, stud.id AS student_id, assgn.file AS file, assgn.file_name AS file_name, assgn.file AS file, assgn.type AS type
                            FROM assignment_student assgn
                            JOIN student stud ON assgn.student_id = stud.id
                            WHERE lecturer_id = '$userID' AND assgn.assignment_id = '$id'";
                    $result = $conn->query($sql);  
                    $num=0;
                    
                    // $targetFilePath = $targetDir . $fileName;
                    // $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){

                            // $targetFilePath = '../../student_assignment/' . $row['file_name'];
                            // $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                            //$ext = end(explode('.', $row['file_name']));
                            $ext = substr(strrchr($row['file_name'], '.'), 1);
                            ++$num;
                    ?>
                        <tr>
                            <th><?= $num ?></th>
                            <td><?= $row['student_name'] ?></td>
                            <td style="text-align: center;"><?= $row['student_id'] ?></td>
                            <td style="text-align: center;"><?= $row['file_name'] ?></td>
                            <td style="text-align: center;">
                                <button id="view" class="btn btn-sm" title="View Content" onclick="window.open('../../../student_assignment/<?= $row['file'] . '.' . $row['type']?>')">
                                    <i class="bi bi-file-earmark-text" style="font-size: 28px; color:blue;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php 
                        }
                    }else   
                        echo "0 result"
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


    <?php include('../../templates/footer.php'); ?>