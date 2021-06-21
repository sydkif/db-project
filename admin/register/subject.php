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
                        <th style="width: 9%;">Subject ID</th>
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

                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div style="text-align: right;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
            </svg>
            New Subject
        </button>


        <!-- Modal -->
        <div style="text-align: left;">
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-header">

                                <h5 class="modal-title" id="staticBackdropLabel">Please enter Subject ID and Name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col-form-label"><b>Subject ID</b> (e.g. BIC21404) </label>
                                    <input class="form-control" name="id" maxlength="8" pattern="[a-zA-Z]{3}[0-9]{5}" required>
                                    <label class="col-form-label"><b>Subject Name</b> (Alphabet Only)</label>
                                    <input class="form-control" name="name" pattern="[a-z A-Z]*" required>
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
            if ($conn->errno == '1062')
                $_SESSION['msg'] = "Subject ID (" . $id . ") already exists.";
            else
                $_SESSION['msg'] = $sql . "<br>" . $conn->error . "<br>" . $conn->errno;
            $_SESSION['status'] = "Fail";
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

    $conn->close();
    ?>
</div>

<?php include('../../templates/footer.php') ?>