<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3><a id="back" class="bi bi-caret-left-fill" href="/admin/dashboard.php"></a>Register Student</h3>
            <hr>
            <?php include('../../templates/alert_msg.php') ?>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 11%;">Student ID</th>
                        <th style="width: auto;">Student Name</th>
                        <th style="width: 10%;">Student Email</th>
                        <th style="width: 12%; text-align: center;">Modified By</th>
                        <th style="width: 13%; text-align: center;">Modified On</th>
                        <th style="width: 11%; text-align: center;">Update</th>
                        <th style="width: 5%; text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    include "../../database/DB.php";

                    $sql = "SELECT * FROM student";
                    $result = $conn->query($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$num;

                    ?>
                            <tr>
                                <td id="id<?= $num ?>"><b><?= $row['id']; ?> <b></td>
                                <td id="name<?= $num ?>" contentEditable="false" style="text-transform: uppercase;"><?= ucfirst($row['name']); ?></td>
                                <td id="modi" style="text-align: center;"><?= $row['email']; ?></td>
                                <td id="modi" style="text-align: center;"><?= $row['modiBy'] ?></td>
                                <td id="modi" style="text-align: center;"><?= date('d-m-Y H:i:s', strtotime($row['modiOn'])); ?></td>
                                <td style="text-align: center;">
                                    <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm updateBtn">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                    <button id="save<?= $num ?>" onclick="update('student',<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-save2" style="color: blue;"></i>
                                    </button>
                                    <button id="cancel<?= $num ?>" onclick="cancel(<?= $num ?>)" class="btn btn-sm cancelBtn">
                                        <i class="bi bi-x-square" style="color: gray;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove('student',<?= $num ?>)">
                                        <i class="bi bi-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else
                        echo "0 results";

                    $conn->close();

                    ?>

                </tbody>
            </table>

        </div>
    </div>
    <br>
    <div style="text-align: right;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"></path>
            </svg>
            New Student
        </button>

        <!-- Modal -->
        <div style="text-align: left;">
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-header">

                                <h5 class="modal-title" id="staticBackdropLabel">Please enter Student ID and Name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col-form-label"><b>Student ID</b></label>
                                    <input class="form-control" id="question" name="id" required>
                                    <label class="col-form-label"><b>Student Name</b></label>
                                    <input class="form-control" id="question" name="name" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    include "../../database/DB.php";
    date_default_timezone_set("Asia/Kuala_Lumpur");
    if (isset($_POST['add'])) {
        $id = $_POST['id'];
        $id = strtoupper($id);
        $name = strtoupper($_POST['name']);
        $email = $id . "@siswa.uthm.edu.my";
        $modiBy = $_SESSION['usersname'];
        $modiOn = date("Y-m-d H:i:s");
        $sql = "INSERT INTO student (id, name, email, password, modiBy, modiOn) VALUES('$id', '$name', '$email', '$id', '$modiBy', '$modiOn')";

        if ($conn->query($sql) === true) {
            // Success
            $_SESSION['msg'] = "Record added successfully!";
            $_SESSION['status'] = "Success";
        } else {
            // Failed
            $_SESSION['msg'] = "Error: " . $sql . " | " . $conn->error;
            $_SESSION['status'] = "Fail";
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

    $conn->close();

    ?>

</div>

<?php include('../../templates/footer.php') ?>