<?php include('../../templates/header.php') ?>


<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3><a id="back" class="bi bi-caret-left-fill" href="/admin/dashboard.php"></a> Register Admin</h3>
            <hr>
            <?php include('../../templates/alert_msg.php') ?>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">Admin ID</th>
                        <th style="width: auto;">Admin Name</th>
                        <th style="width: 11%; text-align: center;">Update</th>
                        <th style="width: 11%; text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody id="table">

                    <?php
                    include "../../database/DB.php";

                    $sql = "SELECT id, name FROM admin";
                    $result = $conn->query($sql);
                    $num = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ++$num;
                    ?>

                            <tr>
                                <td id="id<?= $num ?>"><b><?php echo $row["id"] ?><b></td>
                                <td contentEditable=" false" id="name<?= $num ?>" style="text-transform: uppercase;"><?php echo $row["name"] ?></td>
                                <td style="text-align: center;">
                                    <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)" class="btn btn-sm updateBtn">
                                        <i class="bi bi-pencil-square" style="color: blue;"></i>
                                    </button>
                                    <button id="save<?= $num ?>" onclick="update('admin',<?= $num ?>)" class="btn btn-sm">
                                        <i class="bi bi-save2" style="color: blue;"></i>
                                    </button>
                                    <button id="cancel<?= $num ?>" onclick="cancel(<?= $num ?>)" class="btn btn-sm cancelBtn">
                                        <i class="bi bi-x-square" style="color: gray;"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button id="delete<?= $num ?>" class="btn btn-sm" onclick="remove('admin',<?= $num ?>)">
                                        <i class="bi bi-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>

                    <tr>
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

                                                    <h5 class="modal-title" id="staticBackdropLabel">Register Admin</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label class="col-form-label"><b>Admin ID</b></label>
                                                        <input class="form-control" id="question" name="id" required>
                                                        <label class="col-form-label"><b>Admin Name</b></label>
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

                    if (isset($_POST['add'])) {
                        $id = $_POST['id'];
                        $name = strtoupper($_POST['name']);
                        $sql = "INSERT INTO admin (id, name, password) VALUES ('$id', '$name', '$id')";

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

<?php include '../../templates/footer.php' ?>