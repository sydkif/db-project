<?php include('../../templates/header.php');

$code = $_GET['code'];
$name = $_GET['name'];
$title = $_GET['title'];
$userID = $_SESSION['userId'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="javascript:history.back();"></a>Assignment / Tutorial / Lab Submission</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <h5>Title : <?= $title ?></h5>

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

                    $sql = "SELECT stud.name, stud.id, assgn.file, assgn.file_name
                            FROM assignment_student assgn
                            JOIN student stud ON assgn.student_id = stud.id
                            WHERE lecturer_id = '$userID'";
                    $result = $conn->query($sql);  
                    $num=0;                  

                    if($result->num_rows > 0)
                        while($row->$result->fetch_assoc()){
                            ++$num;
                    ?>
                        <tr>
                            <th><?= $num + 1 ?></th>
                            <td><?= $row['stud.name'] ?></td>
                            <td style="text-align: center;"><?= $row['stud.id'] ?></td>
                            <td style="text-align: center;"><?= $row['file_name'] ?></td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" title="View Content">
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



    <?php include('../../templates/footer.php'); ?>