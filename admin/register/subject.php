<?php include('../../templates/header.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3><a id="back" class="bi bi-caret-left-fill" href="/admin/dashboard.php"></a>Register Subject</h3>
            <hr>
            <?php include('../../templates/alert_msg.php') ?>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">Subject ID</th>
                        <th style="width: auto;">Subject Name</th>
                        <th style="width: 12%; text-align: center;">Modified By</th>
                        <th style="width: 13%; text-align: center;">Modified On</th>
                        <th style="width: 11%; text-align: center;">Update</th>
                        <th style="width: 5%; text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    //connecting to database
                    include "../../database/DB.php";

                    //getting data from db
                    $sql = "SELECT * FROM subject";
                    $result = $conn->query($sql);
                    $num = 0;

                    if ($result->num_rows > 0) {
                        //outputting data in table
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>
                            <tr>
                                <td id="id<?= $num ?>" style="text-transform: uppercase;"><b><?= $row['id']; ?> <b></td>
                                <td id="name<?= $num ?>" contentEditable="false" style="text-transform: uppercase;"><?= $row['name']; ?></td>
                                <td id="modi" style="text-align: center;"><?= $row['modiBy'] ?></td>
                                <td id="modi" style="text-align: center;"><?= date('d-m-Y H:i:s', strtotime($row['modiOn'])); ?></td>
                                <td style="text-align: center;">
                                    <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm updateBtn">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                    <button id="save<?= $num ?>" onclick="update('subject',<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-save2" style="color: blue;"></i>
                                    </button>
                                    <button id="cancel<?= $num ?>" onclick="cancel(<?= $num ?>)" class="btn btn-sm cancelBtn">
                                        <i class="bi bi-x-square" style="color: gray;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove('subject',<?= $num ?>)">
                                        <i class="bi bi-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else
                        echo "0 Result";

                    $conn->close();
                    ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">
                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#staticBackdrop">
                                <i class="bi bi-plus-square" style="color: green;"></i>
                            </button>

                            <!-- Modal -->
                            <div style="text-align: left;">
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST">
                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="staticBackdropLabel">Register Subject</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label class="col-form-label"><b>Subject ID</b></label>
                                                        <input class="form-control" id="question" name="id" required>
                                                        <label class="col-form-label"><b>Subject Name</b></label>
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

                        </td>
                    </tr>


                    <?php

                    include "../../database/DB.php";

                    //Adding data to database
                    if (isset($_POST['add'])) {
                        $id = strtoupper($_POST['id']);
                        $name = strtoupper($_POST['name']);
                        $modiBy = strtoupper($_SESSION['usersname']);
                        $modiOn = date("Y-m-d H:i:s");
                        $sql = "INSERT INTO subject (id, name, modiBy, modiOn) VALUES ('$id', '$name', '$modiBy', '$modiOn')";

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
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('../../templates/footer.php') ?>