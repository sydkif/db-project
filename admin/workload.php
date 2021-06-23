<?php include("../templates/header.php") ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3><a id="back" class="bi bi-caret-left-fill" href="/admin/dashboard.php"></a>Assign Workload Lecturer</h3>
            <hr>
            <?php include('../templates/alert_msg.php') ?>
        </div>

        <div class="table-responsive shadow rounded">
            <table id="table" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: auto;">Lecturer</th>
                        <th style="width: auto;">Subject</th>
                        <th style="width: 8%; text-align:center;">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../database/DB.php";

                    $sql = "SELECT  l.id as lecturer_id, l.name AS lecturer_name, s.id AS subject_id, s.name AS subject_name 
                            FROM subject s
                            JOIN workload wl ON s.id = wl.subject_id
                            JOIN lecturer l ON wl.lecturer_id = l.id;";

                    $result = $conn->query($sql);
                    $num = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                            // $lecturer_name = $row['lecturer_id'];

                    ?>

                            <tr>
                                <form method="post">
                                    <th><?= $num ?></th>
                                    <td style="text-transform: uppercase;"><?= $row['lecturer_name'] ?>
                                        <input type="hidden" name="lecturerId" value="<?= $row['lecturer_id'] ?>">
                                    </td>
                                    <td style="text-transform: uppercase;"><?= $row['subject_name'] ?>
                                        <input type="hidden" name="subjectId" value="<?= $row['subject_id'] ?>">
                                    </td>
                                    <td style="text-align:center;">
                                        <button name="delete" id="delete<?= $num ?>" class="btn btn-sm" onclick="return confirm('Are you sure?');">
                                            <i class="bi bi-trash" style="color: red;"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>


                    <tr>
                        <form method="post">
                            <th></th>
                            <td>
                                <select name="lecturer_id" class="custom-select">
                                    <option selected>Please Choose</option>

                                    <?php
                                    include "../database/DB.php";

                                    $sql = "SELECT id, name FROM lecturer";
                                    $result = $conn->query($sql);
                                    $num = 0;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ++$num;
                                    ?>
                                            <option style="text-transform: uppercase;" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>

                                </select>
                            </td>
                            <td>
                                <select name="subject_id" class="custom-select">
                                    <option style="text-transform: uppercase;" selected>Please Choose</option>

                                    <?php
                                    include "../database/DB.php";

                                    $sql = "SELECT id, name FROM subject";
                                    $result = $conn->query($sql);
                                    $num = 0;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ++$num;
                                    ?>
                                            <option style="text-transform: uppercase;" value="<?= $row['id']  ?>"><?= $row['name'] ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>

                                </select>
                            </td>
                            <td style="text-align:center;">
                                <button name="add" class="btn btn-sm" href="#?">
                                    <i class="bi bi-plus-square" style="color: green;"></i>
                                </button>
                            </td>
                        </form>
                    </tr>

                    <?php

                    include "../database/DB.php";
                    if (isset($_POST['add'])) {

                        $lecturer = $_POST['lecturer_id'];
                        $subject = $_POST['subject_id'];
                        $sql = "INSERT INTO workload (lecturer_id, subject_id) VALUES ('$lecturer', '$subject')";

                        if ($conn->query($sql) === true) {
                            // Success
                            $_SESSION['msg'] = "Record added successfully!";
                            $_SESSION['status'] = "Success";
                        } else {
                            // Failed
                            if ($conn->errno == '1062')
                                $_SESSION['msg'] = "Lecturer ID (" . $lecturer . ") already assigned to Subject ID (" . $subject . ").";
                            else
                                $_SESSION['msg'] = $sql . "<br>" . $conn->error . "<br>" . $conn->errno;
                            $_SESSION['status'] = "Fail";
                        }
                        echo "<meta http-equiv='refresh' content='0'>";
                    }

                    if (isset($_POST['delete'])) {

                        $lecturer = $_POST['lecturerId'];
                        $subject =  $_POST['subjectId'];

                        $sql = "DELETE FROM workload WHERE lecturer_id = '$lecturer' AND subject_id= '$subject'";

                        if ($conn->query($sql) === true) {
                            // Success
                            $_SESSION['msg'] = "Record deleted successfully!";
                            $_SESSION['status'] = "Success";
                        } else {
                            // Failed
                            $_SESSION['msg'] = $sql . "<br>" . $conn->error . "<br>" . $conn->errno;
                            $_SESSION['status'] = "Fail";
                        }
                        echo "<meta http-equiv='refresh' content='0'>";
                    }

                    $conn->close();

                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../templates/footer.php") ?>