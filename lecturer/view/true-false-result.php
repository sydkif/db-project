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
                        <th style="width: 50%;">Student Name</th>
                        <th>Student ID</th>
                        <th style="text-align: center;">Result Quiz True/False</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //Displaying data in table
                    include('../../database/DB.php');

                    $sql = "SELECT  FROM student_quiz WHERE subject_id = '$code'";
                    $result = $conn->querY($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $num++;

                            $count_pass = 0; //Count number of pass 
                            $count_fail = 0; //Count number of fails

                    ?>

                            <tr>
                                <th scope="row" style="text-align: center;"><?= $num + 1 ?></th>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['id'] ?></td>
                                <td style="text-align: center"><?= $row['result'] ?></td>
                            </tr>

                    <?php

                            if ($row['result'] > 2)
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
            <div class="alert alert-success col-2" style="margin-left: 14px;" role="alert">
                Number of Pass: <?= $count_pass ?>
            </div>
            <div class="alert alert-danger col-2" role="alert">
                Number of Fails: <?= $count_fail ?>
            </div>
        </div>
    </div>
</div>



<?php include('../../templates/footer.php'); ?>