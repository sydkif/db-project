<?php include('../../templates/header.php');

$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$userId = $_SESSION['userid'];

?>

<div class="container mt-5 align-items-center">
    <div class="col">
        <h3><a id="back" class="bi bi-caret-left-fill" href="/lecturer/dashboard.php"></a>View True/False Results</h3>
        <hr>
        <h5><?= strtoupper($code) ?> : <?= $name  ?></h5>
        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center; width: 5%;">No</th>
                        <th style="width: auto;">Student Name</th>
                        <th>Student ID</th>
                        <th style="text-align: center; width:10%;">Marks</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //Displaying data in table
                    include('../../database/DB.php');

                    $sql = "SELECT stud.name AS student_name, stud.id AS student_id, sub.tf_marks AS marks
                            FROM student_subject sub
                            JOIN student stud ON sub.student_id = stud.id
                            WHERE sub.subject_id = '$code'";
                    $result = $conn->querY($sql);
                    $num = 0;
                    $count_pass = 0; //Count number of pass 
                    $count_fail = 0; //Count number of fails

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $num++;



                    ?>

                            <tr>
                                <th scope="row" style="text-align: center;"><?= $num ?></th>
                                <td><?= $row['student_name'] ?></td>
                                <td><?= $row['student_id'] ?></td>
                                <td style="text-align: center">
                                    <b class="btn-block badge badge-<?php echo ($row['marks'] > 0) ? 'success' : 'danger' ?> p-2"> <?= $row['marks'] ?>
                                    </b>
                                </td>
                            </tr>

                    <?php

                            if ($row['marks'] > 0)
                                $count_pass++;
                            else
                                $count_fail++;
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>

        <br />
        <div class="row justify-content-start">
            <div class="alert alert-success col-2" style="margin-left: 14px; margin-right:10px;" role="alert">
                Number of Pass: <?= $count_pass ?>
            </div>
            <div class="alert alert-danger col-2" role="alert">
                Number of Fails: <?= $count_fail ?>
            </div>
        </div>
    </div>
</div>



<?php include('../../templates/footer.php'); ?>